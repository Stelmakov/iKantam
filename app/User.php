<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	/**
	 * Determines user role
	 *
	 * @return boolean
	 */
    public function isAdmin() {
        return (bool) $this->role;
    }

    public function articles(){

	    return $this->hasMany('App\Article');
    }

    public function hasArticle($articleId) {

    	return  User::find($this->id)->articles;
    }

}
