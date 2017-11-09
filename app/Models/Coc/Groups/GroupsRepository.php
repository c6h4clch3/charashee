<?php

namespace App\Models\Groups;

use App\Models\Coc\Groups\Group;

class GroupsRepository implements GroupsRepositoryInterface
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    public function loadAllGroups()
    {
        return $this->group->all()->all();
    }

    public function loadGroupById(int $id)
    {
        return $this->group->find($id)->all();
    }

    public function createGroup(string $name)
    {
        return $this->group->create([
            'name' => $name,
        ])->save();
    }

    public function updateGroup(int $id, string $name)
    {
        return $this->group->find($id)->update([
            'name' => $name,
        ])->save();
    }
}
