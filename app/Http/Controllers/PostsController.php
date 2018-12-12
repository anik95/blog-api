<?php

namespace App\Http\Controllers;
use App\Post;
use App\User;
// use App\Validator;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'likes' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $post = new Post;

        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth('api')->user()->id;

        $post->save();

        return response()->json($post);
    }

    public function getPost($id)
    {
        // dd($id);
        $postShow = Post::where('id', $id)->get();
        return response()->json($postShow);
    }

    public function updatePost(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json($validator->errors());
        }

        $postUpdated = Post::where('id', $id)->first();
        // dd($postUpdated);
        $postUpdated->title = $request->input('title');
        $postUpdated->body = $request->input('body');

        $postUpdated->save();

        return response()->json($postUpdated);
    }
}
