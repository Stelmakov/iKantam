<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Article extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'content', 'text', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

	public function user(){

		return $this->belongsTo('App\User');
	}

	public function comments() {

	    return $this->hasMany('App\Comment');
    }
}
