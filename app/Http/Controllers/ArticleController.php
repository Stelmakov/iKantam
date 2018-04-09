<?php
/**
 * Created by PhpStorm.
 * User: stelmakov_i
 * Date: 09.04.2018
 * Time: 19:00
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Validator;

class ArticleController extends Controller
{



	public function addArticle(Request $request) {
		if ($request->isMethod('post')) {

			$this->validate($request, [
				'name' => 'required|max:255',
				'text' => 'required',
				'img' => 'required',
			]);
			$slug = \Slug::make($request->name);
			$i = 1;
			while (Article::whereSlug($slug)->exists()){
				$slug = \Slug::make($request->name . '-' . $i);
				$i++;
			}
			$article = new Article;
			$file = $request->file('img');
			$destinationPath =  public_path().'/img/';
			$filename = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
			$request->file('img')->move($destinationPath, $filename);
			$article->user_id = Auth::user()->id;
			$article->name = $request->name;
			$article->content = htmlentities($request->text);
			$article->slug = $slug;
			$article->img = '/img/'.$filename;
			$article->save();
		}
		return view('articles.add');
	}



	public function editArticle(Request $request, $slug) {
		if ($request->isMethod('post')) {

			$this->validate($request, [
				'name' => 'required|max:255',
				'text' => 'required',
				'img' => 'required',
			]);
			$slug = \Slug::make($request->slug);
			$i = 1;
			while (Article::whereSlug($slug)->exists()){
				$slug = \Slug::make($request->name . '-' . $i);
				$i++;
			}
			$article = new Article;
			$file = $request->file('img');
			$destinationPath =  public_path().'/img/';
			$filename = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
			$request->file('img')->move($destinationPath, $filename);
			$article->user_id = Auth::user()->id;
			$article->name = $request->name;
			$article->content = $request->text;
			$article->slug = $slug;
			$article->img = '/img/'.$filename;
			$article->save();

		} else {
			$article = Article::whereSlug($slug)->get()[0];
		}

		return view('articles.edit', ['article' => $article]);
	}

	public function showArticle(Request $request, $slug){
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'text' => 'required'
            ]);

            $comment = new Comment;
            $comment->content = $request->text;
            $comment->user_id = Auth::user()->id;
            $article = Article::whereSlug($slug)->first();
            $comment->article_id = $article->id;
            $comment->save();
        } else{
            $article = Article::whereSlug($slug)->first();
        }

        if (!$article){
            return response()->view('errors.404');
        }
        $comments = $article->comments()->get();
        return view('articles.show', ['article' => $article, 'comments' => $comments]);
    }

}