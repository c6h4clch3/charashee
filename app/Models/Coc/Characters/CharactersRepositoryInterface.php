<?php

namespace App\Models\Coc\Characters;

use App\Services\ServiceException;

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
    public function loadByPage($page);

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

    /**
     * @param int $character_id
     * @return int
     */
    public function delete(int $character_id);

    /**
     * @param int $user_id
     * @param int $character_id
     * @throws ServiceException
     */
    public function userOwnsCharacterGuard(int $user_id, int $character_id);
}
