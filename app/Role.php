<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['code', 'name', 'display_name', 'order'];

    protected $hidden = [
        'code'
    ];
}
