<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'audio_id','image_id'
    ];

    public function audio() {
        return $this->belongsTo('App\Audio');
    }

    public function image() {
        return $this->belongsTo('App\Image');
    }
}
