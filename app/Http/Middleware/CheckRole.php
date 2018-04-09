<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
		if ($request->user()->role != 1) {
			return response('Forbidden.', 403);
		}

		return $next($request);
	}

}