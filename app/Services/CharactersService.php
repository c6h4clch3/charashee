<?php

namespace App\Services;

use App\Models\Coc\Characters\CharactersRepository;
use App\Models\Coc\Skills\SkillsRepository;
use App\Models\Coc\Tags\TagsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CharactersService
{
    protected $user;
    protected $charactersRepository;
    protected $skillsRepository;
    protected $tagsRepository;

    public function __construct(
        CharactersRepository $charactersRepository,
        SkillsRepository $skillsRepository,
        TagsRepository $tagsRepository
    )
    {
        $this->user = Auth::user();
        $this->charactersRepository = $charactersRepository;
        $this->skillsRepository = $skillsRepository;
        $this->tagsRepository = $tagsRepository;
    }

    public function getAll()
    {
        return array_map(function($character) {
            return $this->plaining($character);
        }, $this->charactersRepository->loadAll());
    }

    public function getAllOwn()
    {
        return array_map(function ($character) {
            return $this->plaining($character);
        }, $this->user->characters()->with(['skills', 'tags'])->get()->all());
    }

    public function getById(int $id)
    {
        $characterModel = $this->charactersRepository->loadById($id);

        return $this->plaining($characterModel);
    }

    public function isOwn(int $id)
    {
        try {
            $this->charactersRepository->userOwnsCharacterGuard(Auth::user()->id, $id);
            return true;
        } catch (ServiceException $e) {
            return false;
        }
    }

    public function getPagenated($page) {
        if (empty($page)) {
            $characters = [];
        } else {
            $characters = array_map(function($character) {
                return $this->plaining($character);
            }, $this->charactersRepository->loadByPage($page));
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
            foreach ($character['tags'] as $tag) {
                $tagRecord = $this->tagsRepository->firstOrCreate($tag);
                $characterRecord->tags()->attach($tagRecord);
            }
            $this->user->characters()->save($characterRecord);

            return $this->plaining($characterRecord);
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

            $characterRecord->tags()->detach();
            foreach ($character['tags'] as $tag) {
                $tagRecord = $this->tagsRepository->firstOrCreate($tag);
                $characterRecord->tags()->attach($tagRecord);
            }

            $this->user->characters()->save($characterRecord);

            return $this->plaining($characterRecord);
        });
    }

    private function plaining($characterModel)
    {
        return [
            'id'            => $characterModel->id,
            'user_id'       => $characterModel->user_id,
            'name'          => $characterModel->name,
            'age'           => $characterModel->age,
            'sex'           => $characterModel->sex,
            'job'           => $characterModel->job,
            'str'           => $characterModel->str,
            'con'           => $characterModel->con,
            'dex'           => $characterModel->dex,
            'pow'           => $characterModel->pow,
            'app'           => $characterModel->app,
            'siz'           => $characterModel->siz,
            'int'           => $characterModel->int,
            'edu'           => $characterModel->edu,
            'hp'            => $characterModel->hp,
            'hp_additional' => $characterModel->hp_additional,
            'mp'            => $characterModel->mp,
            'mp_additional' => $characterModel->mp_additional,
            'san'           => $characterModel->san,
            'comment'       => $characterModel->comment,
            'skills'        => $characterModel->skillData,
            'tags'          => array_map(function($tag) {
                             return $tag['name'];
                         }, $characterModel->tags->toArray()),
        ];
    }
}
