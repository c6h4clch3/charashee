<?php

namespace App\Repositories\Coc\Characters;

interface CharactersRepositoryInterface
{
    /**
     * @return array
     */
    public function getCharactersAll();

    /**
     * @param int $id
     * @return object
     */
    public function getCharacterById(int $id);

    /**
     * @param array $character
     */
    public function createCharacter(array $character);

    /**
     * @param int $id
     * @param array $character
     */
    public function updateCharacter(int $id, array $character);
}
