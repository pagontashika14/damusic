<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'code', 'name', 'user_id', 'image_id', 'description'
    ];

    public function user() {
        return $this->belongsTo('App\User')->select(['users.id','users.name']);
    }

    public function image() {
        return $this->belongsTo('App\Image');
    }

    public function audio() {
        return $this->belongsToMany('App\Audio');
    }
}
