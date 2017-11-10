<?php

namespace App\Models\Coc\Characters;


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
        return $this->character->all()->all();
    }

    public function loadById(int $id)
    {
        return $this->character->find($id)->all();
    }

    public function count()
    {
        $all = $this->character->all()->count();
        $page = ($all / $this->unit) + 1;

        return compact('all', 'page');
    }

    public function loadByPage(int $page)
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
        return $this->character->create($characterRecord)->save();
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
        return $this->character->find($character_id)->update($characterRecord)->save();
    }
}
