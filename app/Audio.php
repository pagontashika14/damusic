<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'nation_id'
    ];

    protected $hidden = [
        'nation_id',
        'pivot'
    ];

    public function singers() {
        return $this->belongsToMany('App\Singer')->select(['singers.id','name','stage_name']);
    }

    public function singers() {
        return $this->belongsToMany('App\Type')->select(['types.id','name']);
    }

    public function nation() {
    	return $this->belongsTo('App\Nation');
    }

    public function links() {
    	return $this->hasMany('App\AudioLink');
    }
}
