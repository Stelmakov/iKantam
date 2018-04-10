<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use App\Article;

class CommentController extends Controller
{

	/**
	 * Deletes comment, enabled only for writer
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function delete(Request $request) {

        $comment = Comment::whereId($request->id)->first();
        $comment->delete();
        $response = array(
            'status' => 'success'
        );
        return response()->json($response);
    }

	/**
	 * Edits comment, enabled only for writer
	 *
	 * @param  Request $request
	 * @return Response
	 */
    public function edit(Request $request) {

        $comment = Comment::whereId($request->id)->first();
        if (!$comment) {
            $response = array(
                'error' => 'Comment not found'
            );
        } else {
            $comment->content = $request->text;
            $comment->save();
            $response = array(
                'status' => 'success'
            );
        }

        return response()->json($response);
    }

}