<?php

namespace App\Models\Coc\Characters;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * @var string
     */
    protected $table = 'coc_characters';

    public function skills()
    {
        return $this->belongsToMany('App\Coc\Skills\Skill', 'coc_character_skills')
            ->withPivot('job_point', 'interest_point', 'others_point')->withTimestamps();
    }

    public function getSkillData() {
        return array_map(function ($skill) {
            return [
                'name' => $skill->name,
                'init' => $skill->init,
                'reference' => $skill->reference,
                'job_point' => $skill->pivot->job_point,
                'interest_point' => $skill->pivot->job_point,
                'others_point' => $skill->pivot->others_point,
            ];
        }, $this->skills);
    }
}
