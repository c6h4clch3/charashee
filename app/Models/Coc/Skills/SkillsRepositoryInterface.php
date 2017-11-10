<?php

namespace App\Models\Coc\Skills;

interface SkillsRepositoryInterface
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
     * @param string $name
     * @param int $init
     * @param $reference
     * @return mixed
     */
    public function firstOrCreate(string $name, int $init, $reference);

    /**
     * @return mixed
     */
    public function deleteUntied();
}
