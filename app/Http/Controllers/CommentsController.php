<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;

class CommentsController extends Controller
{
    public function createComment($request, $postId) {

        $validator = \Validate::make($request->all(), [
            'comment' => 'required'
        ]);

        $newComment = new Comment;
        $newComment->user_id = auth('api')->user()->id;
        $newComment->post_id = $post_id;
        $newComment->comment = $request->input('comment');

        $coment->save();

        return response()->json($newComment);
    }

    public function getComment($commentId) {
        $comment = Comment::where('id', $commentId);
        return response()->json($comment); 
    }

    public function updateComment($commentId) {
        $updatedComment = Comment::where('id', $commentId);

        $updatedComment->comment = $request->input('comment');
        $updatedComment->save();

        return response()->json($updatedComment);
    }
}
