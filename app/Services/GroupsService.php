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
            return [
                'id' => $group->id,
                'name' => $group->name,
            ];
        }, $this->groupsRepository->loadAll()->all());
    }

    public function getAllOwn()
    {
        return $this->user->groups()->all();
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
                'name' => $group->name,
                'characters' => [],
            ];
        }

        return [
            'id' => $group->id,
            'name' => $group->name,
            'characters' => array_map(function($character) {
                return [
                    'id' => $character->id,
                    'name' => $character->name,
                    'age' => $character->age,
                    'sex' => $character->sex,
                    'job' => $character->job,
                ];
            }, $group->characters),
        ];
    }

    public function create(string $name)
    {
        $group = $this->groupsRepository->create($name);
        $this->user->groups()->save($group);

        return $group;
    }

    public function update(int $group_id, string $name)
    {
        $this->groupsRepository->userOwnsGroupsGuard(Auth::user()->id, $group_id);

        $group = $this->groupsRepository->update($group_id, $name);
        return $group;
    }

    public function delete(int $group_id)
    {
        $this->groupsRepository->userOwnsGroupsGuard(Auth::user()->id, $group_id);

        return $this->groupsRepository->delete($group_id);
    }

    public function register(int $group_id, int $character_id)
    {
        $group = $this->groupsRepository->loadById($group_id);
        $character = $this->characterRepository->loadById($character_id);
        $this->groupsRepository->userOwnsGroupsGuard(Auth::user()->id, $group_id);

        $group->characters()->save($character);

        return $group;
    }

    public function registerAll(int $group_id, array $character_ids)
    {
        return DB::transaction(function () use ($group_id, $character_ids) {
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
        $this->groupsRepository->userOwnsGroupsGuard(Auth::user()->id, $group_id);
        return $this->groupRepository->characters()->detach($character_id);
    }
}
