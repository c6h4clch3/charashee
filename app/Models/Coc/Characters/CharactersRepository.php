<?php

namespace App\Models\Coc\Characters;
use Log;

class CharactersRepository implements CharactersRepositoryInterface
{
    protected $character;
    protected $unit;

    public function __construct(Character $character)
    {
        $this->character = $character;
        $this->unit = config('app.api.characters.page_items');
    }

    public function loadAll()
    {
        return $this->character->all();
    }

    public function loadById(int $id)
    {
        return $this->character->find($id);
    }

    public function count()
    {
        $all = $this->character->all()->count();
        $page = ($all / $this->unit) + 1;

        return compact('all', 'page');
    }

    public function loadByPage($page)
    {
        return $this->character->forPage($page, $this->unit);
    }

    public function create(array $character)
    {
        $characterRecord = array_filter($character, function($key) {
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
        $model = $this->character->create($characterRecord);
        return $model;
    }

    public function update(int $character_id, array $character)
    {
        $characterRecord = array_filter($character, function($key) {
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
        $model = $this->character->find($character_id);
        $model->update($characterRecord);
        return $model;
    }
}
