<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    public $timestamps = false;
    protected $fillable = ['stage_name', 'name', 'birthday', 'nation_id', 'image_id', 'description'];

    protected $hidden = [
        'nation_id',
        'pivot'
    ];

    //protected $appends = ['image_link'];

    public function audio()
    {
        return $this->belongsToMany('App\Audio');
    }

    public function image()
    {
        return $this->belongsTo('App\Image');
    }

    public function nation()
    {
        return $this->belongsTo('App\Nation');
    }

    public function getImageLinkAttribute() {
        //dd($this->image());
        return $this->image();
    }
}
