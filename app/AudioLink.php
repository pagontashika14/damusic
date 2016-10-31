<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioLink extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'audio_id', 'name'
    ];

    protected $hidden = [
    	'audio_id',
        'pivot'
    ];

    public function audio() {
    	return $this->belongsTo('App\Audio');
    }
}
