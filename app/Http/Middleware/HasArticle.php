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
		$article = Article::where('slug',$request->slug)->orWhere('id', $request->id)->first();
		if (!$article) {
			return response('Not Found', 404);
		}


		if ($article->user_id != \Auth::user()->id && \Auth::user()->role != 1) {
			return response('Forbidden.', 403);
		}

		return $next($request);
	}

}