<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Celebrity;
class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $celebrity = Celebrity::find($request->get('post_id'));
        $celebrity->comments()->save($comment);

        return back();
    }
    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $celebrity = Celebrity::find($request->get('post_id'));

        $celebrity->comments()->save($reply);

        return back();

    }
}