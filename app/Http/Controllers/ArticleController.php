<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Article;
use App\Comment;
use Validator;

class ArticleController extends Controller
{


	/**
	 * Adds article, enabled only for admin
	 *
	 * @param  Request $request
	 * @return Response
	 */
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


	/**
	 * Edits article, enabled only for admin
	 *
	 * @param  Request $request , string $slug
	 * @return Response
	 */
	public function editArticle(Request $request, $slug) {
		if ($request->isMethod('post')) {

			$this->validate($request, [
				'name' => 'required|max:255',
				'text' => 'required',
			]);
			$article =  Article::whereSlug($slug)->first();
			$slug = \Slug::make($request->name);
			$i = 1;
			if (Article::whereSlug($slug)->exists()){
				while (Article::whereSlug($slug)->exists()){
					$slug = \Slug::make($request->name . '-' . $i);
					$i++;
				}
			}

			if (!\File::exists(public_path().$request->file_path) && $request->file('img')){
				$file = $request->file('img');
				$destinationPath =  public_path().'/img/';
				$filename = str_random(20) .'.' . $file->getClientOriginalExtension() ?: 'png';
				$request->file('img')->move($destinationPath, $filename);
				$article->img = '/img/'.$filename;
			} else {
				$article->img = $request->file_path;
			}

			$article->user_id = Auth::user()->id;
			$article->name = $request->name;
			$article->content = $request->text;
			$article->slug = $slug;
			$article->save();

		} else {
			$article = Article::whereSlug($slug)->get()[0];
		}

		if (!$article){
			return response()->view('errors.404');
		}

		return view('articles.edit', ['article' => $article]);
	}

	/**
	 * Displays article
	 *
	 * @param  Request $request , string $slug
	 * @return Response
	 */
	public function showArticle(Request $request, $slug){
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'text' => 'required'
            ]);

            // Protection from receiving another comment after page refresh
	        if(!$request->session()->has('check')){
		        $request->session()->set('check',$request->_check);
		        $request->session()->save();
		        $check = true;
	        } else {
		        if($request->_check != $request->session()->get('check')){
			        $request->session()->set('check',$request->_check);
			        $request->session()->save();
			        $check = true;
		        } else {
			        $check = false;
	        }
	        }
	        if(!$check){
		        return redirect('/');
	        }

	        // Save comment
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

	/**
	 * Deletes article
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function deleteArticle(Request $request) {
	    if ($request->isMethod('post')) {
		    $article = Article::whereId($request->id)->first();
		    $article->delete();
		    $response = array(
			    'status' => 'success'
		    );
		    return response()->json($response);
	    }
    }

}