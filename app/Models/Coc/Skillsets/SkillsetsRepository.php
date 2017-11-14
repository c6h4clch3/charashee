<?php

namespace App\Models\Coc\Skillsets;

class SkillsetsRepository implements SkillsetsRepositoryInterface
{
    protected $skillset;

    public function __construct(Skillset $skillset)
    {
        $this->skillset = $skillset;
    }

    public function loadAll()
    {
        return $this->skillset->all();
    }

    public function loadById(int $id)
    {
        return $this->skillset->with('skills')->find($id);
    }
}
