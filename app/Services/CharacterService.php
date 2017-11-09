<?php

namespace App\Services;

use App\Models\Coc\Characters\CharactersRepository;

class CharacterService
{
    protected $user;
    protected $repository;

    public function __construct(CharactersRepository $repository)
    {
        $this->user = Auth::user();
        $this->repository = $repository;
    }

    public function create(array $character)
    {
        $this->repository->createCharacter($this->user->id, $character);
    }
}
