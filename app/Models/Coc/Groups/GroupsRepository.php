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

    public function loadAll()
    {
        return $this->group->all();
    }

    public function loadById(int $id)
    {
        return $this->group->find($id);
    }

    public function create(string $name)
    {
        return $this->group->create([
            'name' => $name,
        ])->save();
    }

    public function update(int $id, string $name)
    {
        return $this->group->find($id)->update([
            'name' => $name,
        ])->save();
    }
}
