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
     * @param int user_id
     * @param array $character
     */
    public function createCharacter(int $user_id, array $character);

    /**
     * @param int $user_id
     * @param int $character_id
     * @param array $character
     */
    public function updateCharacter(int $user_id, int $character_id, array $character);
}
