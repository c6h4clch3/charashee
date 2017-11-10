<?php

namespace App\Models\Coc\Characters;

interface CharactersRepositoryInterface
{
    /**
     * @return array
     * @return mixed
     */
    public function loadAll();

    /**
     * @param int $id
     * @return mixed
     */
    public function loadById(int $id);

    /**
     * @return mixed
     */
    public function count();

    /**
     * @param int $page
     * @return mixed
     */
    public function loadByPage(int $page);

    /**
     * @param array $character
     * @return mixed
     */
    public function create(array $character);

    /**
     * @param int $character_id
     * @param array $character
     * @return mixed
     */
    public function update(int $character_id, array $character);
}
