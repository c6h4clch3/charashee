<?php

namespace App\Models\Groups;

interface GroupsRepositoryInterface
{
    public function loadAllGroups();

    public function loadGroupById(int $id);
}
