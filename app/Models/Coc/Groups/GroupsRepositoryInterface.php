<?php

namespace App\Models\Groups;

interface GroupsRepositoryInterface
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
    public function create(string $name);

    /**
     * @param int $id
     * @param string $name
     * @return mixed
     */
    public function update(int $id, string $name);
}
