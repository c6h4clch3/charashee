<?php

namespace App\Services;

use App\Models\Coc\Skillsets\SkillsetsRepository;

class SkillsetsService
{
    protected $skillsetsRepository;

    public function __construct(SkillsetsRepository $skillsetsRepository)
    {
        $this->skillsetsRepository = $skillsetsRepository;
    }

    public function getAll()
    {
        return $this->skillsetsRepository->loadAll();
    }
}