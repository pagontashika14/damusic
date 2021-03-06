<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Audio extends Model
{
	public $timestamps = false;
    protected $fillable = [
        'code', 'name', 'nation_id', 'user_id'
    ];

    protected $hidden = [
        'nation_id',
        'pivot'
    ];

    public function singers() {
        return $this->belongsToMany('App\Singer')->select(['singers.id','name','stage_name','singers.image_id']);
    }

    public function composer() {
        return $this->belongsToMany('App\Singer','audio_composer')->select(['singers.id','name','stage_name','singers.image_id']);
    }

    public function types() {
        return $this->belongsToMany('App\Type')->select(['types.id','name']);
    }

    public function nation() {
    	return $this->belongsTo('App\Nation');
    }

    public function links() {
    	return $this->hasMany('App\AudioLink');
    }

    public function lyrics() {
        return $this->hasMany('App\Lyric')->with('user');
    }

    public function user() {
        return $this->belongsTo('App\User')->select(['users.id','users.name']);
    }

    public function views() {
        return $this->hasMany('App\AudioView');
    }

    public function viewsOfMonth() {
        $now = Carbon::now();
        $oneMonthAgo = Carbon::now()->subMonth();
        return $this->hasMany('App\AudioView')
            ->whereBetween('created_at',[$oneMonthAgo->toDateTimeString(),$now->toDateTimeString()]);
    }

}
