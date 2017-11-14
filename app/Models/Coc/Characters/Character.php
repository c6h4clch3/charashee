<?php

namespace App\Models\Coc\Characters;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    /**
     * @var string
     */
    protected $table = 'coc_characters';

    protected $fillable = [
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
    ];

    public function skills()
    {
        return $this->belongsToMany('App\Models\Coc\Skills\Skill', 'coc_character_skills')
            ->withPivot('job_point', 'interest_point', 'others_point')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getSkillData() {
        return array_map(function ($skill) {
            return [
                'name' => $skill->name,
                'init' => $skill->init,
                'reference' => $skill->reference,
                'job_point' => $skill->pivot->job_point,
                'interest_point' => $skill->pivot->interest_point,
                'others_point' => $skill->pivot->others_point,
            ];
        }, $this->skills);
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Coc\Groups\Group', 'coc_group_characters')
            ->withTimestamps();
    }
}