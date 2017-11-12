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
        return array_map(function($skillset) {
            return [
                'id'   => $skillset->id,
                'name' => $skillset->name,
            ];
        }, $this->skillsetsRepository->loadAll()->all());
    }

    public function getById(int $id)
    {
        $skillset = $this->skillsetsRepository->loadById($id);
        return [
            'id'     => $skillset->id,
            'name'   => $skillset->name,
            'skills' => array_map(function($skill) {
                return [
                    'name'      => $skill->name,
                    'init'      => $skill->init,
                    'reference' => $skill->reference,
                ];
            }, $skillset->skills()->get()->all()),
        ];
    }
}