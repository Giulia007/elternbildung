<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        //for debugging purposes
        $message = '';

            $comment = new Comment;
            $comment->article_id = $data['article_id'];
            $comment->user_id = auth()->user()->id;
            $comment->article_id = $data['article_id'];
            $comment->highlight = $data['highlight'];
            $comment->comment = $data['comment'];
            $comment->selection = $data['userSelection'];
            $comment->private_note = $data['note'];
            $comment->save();

        return response()->json([$message]);
    }

    public function destroy(Request $request, $comment_id) {

        //for debugging purposes
        $message = 'WORKS!!!!!';
        $data = $request->all();

        $comment = Comment::where('id', $comment_id)->delete();

        if($comment) {
            $message = 'comment deleted';
        }

        return response()->json([$message]);

    }
}
