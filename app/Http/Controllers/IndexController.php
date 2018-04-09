<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Article;

class IndexController extends Controller
{
	/**
	 * Show all articles
	 *
	 * @return Response
	 */
	public function index()
	{

		$articles = Article::paginate(10);
		return view('index',['articles' => $articles]);
	}
}