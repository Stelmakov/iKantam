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
        'name', 'content', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

	/**
	 * Gets user by user_id
	 *
	 * @return User
	 */
	public function user(){

		return $this->belongsTo('App\User');
	}

	/**
	 * Gets comments for current article
	 *
	 * @return Comment
	 */
	public function comments() {

	    return $this->hasMany('App\Comment');
    }
}
