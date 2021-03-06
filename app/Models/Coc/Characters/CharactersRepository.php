<?php

namespace App\Models\Coc\Characters;
use App\Services\ServiceException;
use Log;

class CharactersRepository implements CharactersRepositoryInterface
{
    protected $character;
    protected $unit;

    /**
     * @inheritdoc
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
        $this->unit = config('app.api.characters.page_items');
    }

    /**
     * @inheritdoc
     */
    public function loadAll()
    {
        return $this->character->with(['skills', 'tags'])->get()->all();
    }

    /**
     * @inheritdoc
     */
    public function loadById(int $id)
    {
        return $this->character->with(['skills', 'tags'])->find($id);
    }

    /**
     * @inheritdoc
     */
    public function count()
    {
        $all = $this->character->all()->count();
        $page = (int)($all / $this->unit) + ($all % $this->unit === 0 ? 0 : 1);

        return compact('all', 'page');
    }

    /**
     * @inheritdoc
     */
    public function loadByPage($page)
    {
        return $this->character->with(['skills', 'tags'])->forPage($page, $this->unit)->get()->all();
    }

    /**
     * @inheritdoc
     */
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
                'hp_additional',
                'mp',
                'mp_additional',
                'san',
                'mythos_skill',
                'comment',
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $model = $this->character->create($characterRecord);
        return $model;
    }

    /**
     * @inheritdoc
     */
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
                'hp_additional',
                'mp',
                'mp_additional',
                'san',
                'mythos_skill',
                'comment',
            ]);
        }, ARRAY_FILTER_USE_KEY);
        $model = $this->character->find($character_id);
        $model->update($characterRecord);
        return $model;
    }

    /**
     * @inheritdoc
     */
    public function delete(int $character_id)
    {
        return $this->character->destroy($character_id);
    }

    /**
     * @inheritdoc
     */
    public function userOwnsCharacterGuard(int $user_id, int $character_id)
    {
        $character = $this->character->find($character_id);
        if ($character->user_id !== $user_id) {
            throw new ServiceException('自身の所有するキャラクターのみ更新できます');
        }
    }
}
