<?php

namespace App\Models\Coc\Skills;

class SkillsRepository implements SkillsRepositoryInterface
{
    protected $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function loadAll()
    {
        return $this->skill->all()->all();
    }

    public function loadById(int $id)
    {
        return $this->skill->find($id)->all();
    }

    public function firstOrCreate(string $name, int $init, $reference)
    {
        return $this->skill->firstOrCreate([
            'name' => $name,
            'init' => $init,
            'reference' => $reference,
        ]);
    }

    public function deleteUntiedSkill()
    {
        $this->doesntHave('characters')->doesntHave('skillsets')->delete();
    }
}