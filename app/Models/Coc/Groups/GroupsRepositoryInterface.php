<?php

namespace App\Models\Groups;

interface GroupsRepositoryInterface
{
    public function loadAllGroups();

    public function loadGroupById(int $id);

    public function createGroup(string $name);

    public function updateGroup(int $id, string $name);
}
