<?php

namespace App\Models\Coc\Skills;

interface SkillsRepositoryInterface
{
    public function loadAll();

    public function loadById(int $id);

    public function firstOrCreate(string $name, int $init, $reference);

    public function deleteUntiedSkill();
}