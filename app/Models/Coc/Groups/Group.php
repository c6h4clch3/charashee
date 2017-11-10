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
        return $this->hasMany('App\Models\Characters\Character');
    }
}
