<?php

namespace App\Http\Middleware;

use Closure;
use App\Comment;

class HasComment
{
	/**
	 * Обработка входящего запроса.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string  $role
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

		if (!isset($request->id)) {
			return response('Not Found', 404);
		}
		$comment = Comment::whereId($request->id)->first();
		if ($comment->user_id != \Auth::user()->id && \Auth::user()->role != 1) {
			return response('Forbidden.', 403);
		}

		return $next($request);
	}

}