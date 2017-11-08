<?php

namespace App\Repositories\Coc\Characters;

use App\Repositories\Coc\Characters\CharactersRepositoryInterface;
use App\Models\Coc\Characters\Character;
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
        return $this->$character->all();
    }

    public function getCharacterById(int $id)
    {
        return $this->$character->find($id);
    }

    public function createCharacter(int $user_id, array $character)
    {
        DB::transaction(function() use ($user_id, $character) {
            $record = array_filter($character, function($key) {
                return in_array($key, [
                    'name',
                    'age',
                    'sex',
                    'job',
                    'str',
                    'con',
                    'dex',
                    'pow',
                    'app',
                    'siz',
                    'int',
                    'edu',
                    'hp',
                    'mp',
                    'san',
                    'comment',
                ]);
            }, ARRAY_FILTER_USE_KEY);

            $created = $this->character->create($record);

            foreach($character['skills'] as $skill) {
                $target = $this->skills->firstOrCreate([
                    'name' => $skill['name'],
                    'init' => $skill['init'],
                    'reference' => $skill['reference'],
                ]);

                $created->skills()->attach($target, [
                    'job_point' => $skill['job_point'],
                    'interest_point' => $skill['interest_point'],
                    'others_point' => $skill['others_point'],
                ]);
            }

            $this->user->find($user_id)->characters()->save($created);
        });
    }

    public function updateCharacter(int $user_id, int $character_id, array $character)
    {
        DB::transaction(function() use ($character_id, $character) {
            $record = array_filter($character, function($key) {
                return in_array($key, [
                    'name',
                    'age',
                    'sex',
                    'job',
                    'str',
                    'con',
                    'dex',
                    'pow',
                    'app',
                    'siz',
                    'int',
                    'edu',
                    'hp',
                    'mp',
                    'san',
                    'comment',
                ]);
            }, ARRAY_FILTER_USE_KEY);

            $targetCharacter = $this->character->where('user_id', $user_id)->find($character_id)->update($record);

            $targetCharacter->skills()->detach();
            foreach($character['skills'] as $skill) {
                $targetSkill = $this->skills->firstOrCreate([
                    'name' => $skill['name'],
                    'init' => $skill['init'],
                    'reference' => $skill['reference'],
                ]);

                $targetCharacter->skills()->attach($targetSkill, [
                    'job_point' => $skill['job_point'],
                    'interest_point' => $skill['interest_point'],
                    'others_point' => $skill['others_point'],
                ]);
            }
        });
    }
}