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
            ->withTimestamps();
    }

    public function characters()
    {
        return $this->belongsToMany('App\Models\Coc\Characters\Character', 'coc_character_skills')
            ->withPivot('job_point', 'interest_point', 'others_point')->withTimestamps();
    }
}
