<?php

namespace App\Models\Coc\Skillsets;

use Illuminate\Database\Eloquent\Model;

class Skillset extends Model
{
    /**
     * @var string
     */
    protected $table = 'coc_skillsets';

    public function skills()
    {
        return $this->belongsToMany('App\Models\Coc\Skills\Skill', 'coc_skillset_skills')
            ->withTimestamps();
    }
}
