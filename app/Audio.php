<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'nation_id'
    ];
}
