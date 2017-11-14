<?php

namespace App\Models\Coc\Groups;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * @var string
     */
    protected $table = 'coc_groups';

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function characters()
    {
        return $this->belongsToMany('App\Models\Coc\Characters\Character', 'coc_group_characters')
            ->withTimestamps();
    }
}
