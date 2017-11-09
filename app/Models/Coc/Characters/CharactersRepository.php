<?php

namespace App\Models\Coc\Characters;

use App\Models\Coc\Skills\Skill;
use App\User;

class CharactersRepository implements CharactersRepositoryInterface
{
    protected $character;
    protected $skill;
    protected $user;

    public function __construct(Character $character, User $user, Skill $skill)
    {
        $this->character = $character;
        $this->skill = $skill;
        $this->user = $user;
    }

    public function getCharactersAll()
    {
        return $this->character->all()->all();
    }

    public function getCharacterById(int $id)
    {
        return $this->character->find($id)->all();
    }

    public function createCharacter(array $character)
    {
        return $this->character->create($character)->save();
    }

    public function updateCharacter(int $character_id, array $character)
    {
        return $this->character->find($character_id)->update($character)->save();
    }
}
