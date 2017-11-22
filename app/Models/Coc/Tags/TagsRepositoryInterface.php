<?php

namespace App\Models\Coc\Tags;

interface TagsRepositoryInterface
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
     * @return mixed
     */
    public function firstOrCreate(string $name);

    /**
     * @return mixed
     */
    public function deleteUntied();
}
