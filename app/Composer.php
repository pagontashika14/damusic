<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composer extends Model
{
    public $timestamps = false;
    protected $table = 'singers';
    protected $fillable = ['stage_name', 'name', 'birthday', 'nation_id', 'image_id', 'description'];
}
