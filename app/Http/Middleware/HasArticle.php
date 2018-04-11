<?php

namespace App\Http\Middleware;

use Closure;
use App\Article;

class HasArticle
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
		$article = Article::whereSlug($request->slug);
		if ($article->user_id != $request->user()->id && $request->user()->role != 1) {
			return response('Forbidden.', 403);
		}

		return $next($request);
	}

}