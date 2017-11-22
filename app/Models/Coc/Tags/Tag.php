<?php

namespace App\Models\Coc\Tags;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'coc_tags';

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'create_at',
        'update_at',
    ];

    public function characters()
    {
        return $this->belongsToMany(
            'App\Models\Coc\Characters\Character',
            'coc_character_tags'
        )->withTimestamps();
    }
}
