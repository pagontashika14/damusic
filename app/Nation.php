<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name'
    ];
}
