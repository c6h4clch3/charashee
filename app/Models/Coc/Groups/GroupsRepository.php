<?php

namespace App\Models\Groups;

use App\Models\Coc\Groups\Group;
use App\Services\ServiceException;

class GroupsRepository implements GroupsRepositoryInterface
{
    protected $group;

    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @inheritdoc
     */
    public function loadAll()
    {
        return $this->group->all();
    }

    /**
     * @inheritdoc
     */
    public function loadById(int $id)
    {
        return $this->group->find($id);
    }

    /**
     * @inheritdoc
     */
    public function create(string $name)
    {
        return $this->group->create([
            'name' => $name,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function update(int $id, string $name)
    {
        return $this->group->find($id)->update([
            'name' => $name,
        ])->save();
    }

    /**
     * @inheritdoc
     */
    public function delete(int $id)
    {
        return $this->group->destroy($id);
    }

    /**
     * @inheritdoc
     */
    public function userOwnsGroupGuard(int $user_id, int $group_id)
    {
        $group = $this->group->find($group_id);
        if ($group->id !== $user_id) {
            throw new ServiceException('自身の所有するグループのみ更新できます');
        }
    }
}
