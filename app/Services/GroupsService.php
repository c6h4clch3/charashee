<?php

namespace App\Services;

use App\Models\Coc\Characters\CharactersRepository;
use App\Models\Groups\GroupsRepository;

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
        return $this->groupsRepository->loadById($id);
    }

    public function create(string $name)
    {
        return $this->groupsRepository->create($name);
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
}
