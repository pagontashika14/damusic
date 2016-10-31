<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    public $timestamps = false;
    protected $fillable = ['code', 'stage_name', 'name', 'birthday', 'nation_id', 'image_id', 'description'];

    protected $hidden = [
        'nation_id',
        'pivot'
    ];

    public function audio()
    {
        return $this->belongsToMany('App\Audio');
    }
}
