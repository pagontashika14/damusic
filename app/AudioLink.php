<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helper\MP3File;
use File;

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

    protected $appends = ['bit_rate'];

    public function audio() {
    	return $this->belongsTo('App\Audio');
    }

    public function getBitRateAttribute() {
        $fileName = storage_path('/app'.$this->name.'.mp3');
        $mp3file = new MP3File($fileName);
        return $mp3file->getBitrate();
    }
}
