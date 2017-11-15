<?php

namespace App\Models\Coc\Skills;

class SkillsRepository implements SkillsRepositoryInterface
{
    protected $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    /**
     * @inheritdoc
     */
    public function loadAll()
    {
        return $this->skill->all();
    }

    /**
     * @inheritdoc
     */
    public function loadById(int $id)
    {
        return $this->skill->find($id);
    }

    /**
     * @inheritdoc
     */
    public function firstOrCreate(string $name, int $init, $reference)
    {
        return $this->skill->firstOrCreate([
            'name' => $name,
            'init' => $init,
            'reference' => $reference,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function deleteUntied()
    {
        $this->doesntHave('characters')->doesntHave('skillsets')->delete();
    }
}
