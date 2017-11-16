<?php

namespace App\Services;

use App\Models\Coc\Characters\CharactersRepository;
use App\Models\Coc\Skills\SkillsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CharactersService
{
    protected $user;
    protected $charactersRepository;
    protected $skillsRepository;

    public function __construct(CharactersRepository $charactersRepository, SkillsRepository $skillsRepository)
    {
        $this->user = Auth::user();
        $this->charactersRepository = $charactersRepository;
        $this->skillsRepository = $skillsRepository;
    }

    public function getAll()
    {
        return $this->charactersRepository->loadAll();
    }

    public function getAllOwn()
    {
        return $this->user->characters->all();
    }

    public function getById(int $id)
    {
        $characterModel = $this->charactersRepository->loadById($id);

        return [
            'name'    => $characterModel->name,
            'age'     => $characterModel->age,
            'sex'     => $characterModel->sex,
            'job'     => $characterModel->job,
            'str'     => $characterModel->str,
            'con'     => $characterModel->con,
            'dex'     => $characterModel->dex,
            'pow'     => $characterModel->pow,
            'app'     => $characterModel->app,
            'siz'     => $characterModel->siz,
            'int'     => $characterModel->int,
            'edu'     => $characterModel->edu,
            'hp'      => $characterModel->hp,
            'mp'      => $characterModel->mp,
            'san'     => $characterModel->san,
            'comment' => $characterModel->comment,
            'skills'  => $characterModel->skillData,
        ];
    }

    public function getPagenated($page) {
        if (is_null($page)) {
            $characters = $this->charactersRepository->loadAll();
        } else {
            $characters = $this->charactersRepository->loadByPage($page);
        }
        $info = $this->charactersRepository->count();

        return compact('characters', 'info');
    }

    public function create(array $character)
    {
        return DB::transaction(function() use ($character) {
            $characterRecord = $this->charactersRepository->create($character);

            foreach ($character['skills'] as $skill) {
                $name = $skill['name'];
                $init = $skill['init'];
                $reference = $skill['reference'];

                $skillRecord = $this->skillsRepository->firstOrCreate($name, $init, $reference);
                $characterRecord->skills()->attach($skillRecord, [
                    'job_point'      => $skill['job_point'],
                    'interest_point' => $skill['interest_point'],
                    'others_point'   => $skill['others_point'],
                ]);
            }
            $this->user->characters()->save($characterRecord);

            return $characterRecord;
        });
    }

    public function update(int $id, array $character)
    {
        return DB::transaction(function() use ($id, $character) {
            $this->charactersRepository->userOwnsCharacterGuard(Auth::user()->id, $id);
            $characterRecord = $this->charactersRepository->update($id, $character);

            $characterRecord->skills()->detach();
            foreach ($character['skills'] as $skill) {
                $name = $skill['name'];
                $init = $skill['init'];
                $reference = $skill['reference'];

                $skillRecord = $this->skillsRepository->firstOrCreate($name, $init, $reference);
                $characterRecord->skills()->attach($skillRecord, [
                    'job_point'      => $skill['job_point'],
                    'interest_point' => $skill['interest_point'],
                    'others_point'   => $skill['others_point'],
                ]);
            }

            $this->user->characters()->save($characterRecord);

            return $characterRecord;
        });
    }
}
