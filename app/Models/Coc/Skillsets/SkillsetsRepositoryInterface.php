<?php

namespace App\Models\Coc\Skillsets;

interface SkillsetsRepositoryInterface
{
    public function loadAll();

    public function loadById(int $id);
}