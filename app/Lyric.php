<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lyric extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audio_id', 'user_id', 'lyric'
    ];

    public function audio() {
    	return $this->belongsTo('App\Audio');
    }
    public function user() {
    	return $this->belongsTo('App\User')->select(['users.id','users.name']);
    }
}
