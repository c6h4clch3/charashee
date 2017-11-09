<?php

namespace App\Models\Coc\Characters;

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
     * @param int $character_id
     * @param array $character
     */
    public function updateCharacter(int $character_id, array $character);
}
