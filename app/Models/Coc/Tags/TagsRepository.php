<?php

namespace App\Models\Coc\Tags;

class TagsRepository implements TagsRepositoryInterface
{
    protected $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    /**
     * @inheritdoc
     */
    public function loadAll()
    {
        return $this->tag->all();
    }

    /**
     * @inheritdoc
     */
    public function loadById(int $id)
    {
        return $this->tag->find($id);
    }

    /**
     * @inheritdoc
     */
    public function firstOrCreate(string $name)
    {
        return $this->tag->firstOrCreate([
            'name' => $name,
        ]);
    }

    /**
     * @inheritdoc
     */
    public function deleteUntied()
    {
        $this->doesntHave('characters')->delete();
    }
}
