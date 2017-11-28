<?php

namespace App\Models\Coc\Skillsets;

interface SkillsetsRepositoryInterface
{
    /**
     * @return mixed
     */
    public function loadAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function loadById(int $id);

    /**
     * @param int $user_id
     * @return mixed
     */
    public function loadOwned(int $user_id);
}
