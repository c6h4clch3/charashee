<?php

namespace App\Models\Coc\Skills;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    /**
     * @var string
     */
    protected $table = 'coc_skills';

    public function skillsets()
    {
        return $this->belongsToMany('App\Models\Coc\Skillsets\Skillset', 'coc_skillset_skills')
            ->withPivot('is_option')->withTimestamps();
    }
}
