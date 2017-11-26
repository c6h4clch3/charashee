<?php

namespace App\Models\Coc\Skillsets;

class SkillsetsRepository implements SkillsetsRepositoryInterface
{
    protected $skillset;

    public function __construct(Skillset $skillset)
    {
        $this->skillset = $skillset;
    }

    /**
     * @inheritdoc
     */
    public function loadAll()
    {
        return $this->skillset->all();
    }

    /**
     * @inheritdoc
     */
    public function loadById(int $id)
    {
        return $this->skillset->with('skills')->find($id);
    }

    /**
     * @inheritdoc
     */
    public function loadOwned(int $user_id)
    {
        return $this->skillset
            ->where('is_custom', false)
            ->orWhere(function($query) use ($user_id) {
                $query->where('is_custom', 'true')->where('user_id', $user_id);
            })->get();
    }
}
