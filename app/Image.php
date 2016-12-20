<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'name'
    ];

    public function singers()
    {
        return $this->hasMany('App\Singer');
    }
}
