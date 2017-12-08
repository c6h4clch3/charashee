<?php

namespace App\Services;

use App\Models\Coc\Characters\CharactersRepository;
use App\Models\Groups\GroupsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupsService
{
    protected $user;
    protected $groupsRepository;
    protected $characterRepository;

    public function __construct(GroupsRepository $groupsRepository, CharactersRepository $charactersRepository)
    {
        $this->user                = Auth::user();
        $this->groupsRepository    = $groupsRepository;
        $this->characterRepository = $charactersRepository;
    }

    public function getAll()
    {
        return array_map(function($group) {
            $characters = [];
            if (count($group->characters)) {
                $characters = array_map(function($character) {
                    return [
                        'id' => $character->id,
                        'name' => $character->name,
                        'age' => $character->age,
                        'sex' => $character->sex,
                        'job' => $character->job,
                    ];
                }, $group->characters->all());
            }
            return [
                'id' => $group->id,
                'user_id' => $group->user_id,
                'name' => $group->name,
                'description' => $group->description,
                'characters' => $characters,
            ];
        }, $this->groupsRepository->loadAll()->all());
    }

    public function getAllOwned()
    {
        return array_map(function($group) {
            $characters = [];
            if (count($group->characters)) {
                $characters = array_map(function($character) {
                    return [
                        'id' => $character->id,
                        'name' => $character->name,
                        'age' => $character->age,
                        'sex' => $character->sex,
                        'job' => $character->job,
                    ];
                }, $group->characters->all());
            }
            return [
                'id' => $group->id,
                'user_id' => $group->user_id,
                'name' => $group->name,
                'description' => $group->description,
                'characters' => $characters,
            ];
        }, $this->user->groups->all());
    }

    public function getById(int $id)
    {
        $group = $this->groupsRepository->loadById($id);

        if (is_null($group)) {
            return [];
        }

        if (count($group->characters) === 0) {
            return [
                'id' => $group->id,
                'user_id' => $group->user_id,
                'name' => $group->name,
                'description' => $group->description,
                'characters' => [],
            ];
        }

        return [
            'id' => $group->id,
            'user_id' => $group->user_id,
            'name' => $group->name,
            'description' => $group->description,
            'characters' => array_map(function($character) {
                return [
                    'id' => $character->id,
                    'name' => $character->name,
                    'age' => $character->age,
                    'sex' => $character->sex,
                    'job' => $character->job,
                ];
            }, $group->characters->all()),
        ];
    }

    public function getOwnedById(int $id)
    {
        $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $id);
        $group = $this->groupsRepository->loadById($id);

        if (is_null($group)) {
            return [];
        }

        if (count($group->characters) === 0) {
            return [
                'id' => $group->id,
                'user_id' => $group->user_id,
                'name' => $group->name,
                'description' => $group->description,
                'characters' => [],
            ];
        }

        return [
            'id' => $group->id,
            'user_id' => $group->user_id,
            'name' => $group->name,
            'description' => $group->description,
            'characters' => array_map(function($character) {
                return [
                    'id' => $character->id,
                    'name' => $character->name,
                    'age' => $character->age,
                    'sex' => $character->sex,
                    'job' => $character->job,
                ];
            }, $group->characters->all()),
        ];
    }

    public function create(string $name, string $description)
    {
        $group = $this->groupsRepository->create($name, $description);
        $this->user->groups()->save($group);

        return $group;
    }

    public function update(int $group_id, string $name, string $description)
    {
        $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $group_id);

        $group = $this->groupsRepository->update($group_id, $name, $description);
        return $group;
    }

    public function delete(int $group_id)
    {
        $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $group_id);

        return $this->groupsRepository->delete($group_id);
    }

    public function register(int $group_id, int $character_id)
    {
        $group = $this->groupsRepository->loadById($group_id);
        $character = $this->characterRepository->loadById($character_id);
        $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $group_id);

        $ids = array_map(function($character) {
            return $character->id;
        }, $group->characters->all());

        $ids[] = $character_id;
        $group->characters()->sync(array_unique($ids));

        $group = $this->groupsRepository->loadById($group_id);

        return [
            'id' => $group->id,
            'user_id' => $group->user_id,
            'name' => $group->name,
            'description' => $group->description,
            'characters' => array_map(function($character){
                return [
                    'id' => $character->id,
                    'name' => $character->name,
                    'age' => $character->age,
                    'sex' => $character->sex,
                    'job' => $character->job,
                ];
            }, $group->characters->all()),
        ];
    }

    public function registerAll(int $group_id, array $character_ids)
    {
        return DB::transaction(function () use ($group_id, $character_ids) {
            $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $group_id);
            $group = $this->groupsRepository->loadById($group_id);

            foreach ($character_ids as $character_id) {
                $character = $this->characterRepository->loadById($character_id);

                $group->characters()->save($character);
            }

            return $group;
        });
    }

    public function unregister(int $group_id, int $character_id)
    {
        $this->groupsRepository->userOwnsGroupGuard(Auth::user()->id, $group_id);
        return $this->groupsRepository->loadById($group_id)->characters()->detach($character_id);
    }
}
