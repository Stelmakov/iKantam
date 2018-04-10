<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Comment extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id','article_id'
    ];

	/**
	 * Gets user by user_id
	 *
	 * @return User
	 */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

	/**
	 * Gets article by article_id
	 *
	 * @return Article
	 */
    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
