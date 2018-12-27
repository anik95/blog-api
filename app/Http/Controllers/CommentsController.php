<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comment;

class CommentsController extends Controller
{
    public function createComment(Request $request, $postId) {

        $validator = \Validator::make($request->all(), [
            'comment' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $newComment = new Comment;
        $newComment->user_id = auth('api')->user()->id;
        $newComment->post_id = $postId;
        $newComment->comment = $request->input('comment');

        $newComment->save();

        return response()->json($newComment);
    }

    public function getComment($postId) {
        $comment = Comment::where('post_id', $postId)->get();
        return response()->json($comment); 
    }

    public function updateComment(Request $request, $commentId) {
        $updatedComment = Comment::where('id', $commentId)->first();

        $updatedComment->comment = $request->input('comment');
        $updatedComment->save();

        return response()->json($updatedComment);
    }
}
