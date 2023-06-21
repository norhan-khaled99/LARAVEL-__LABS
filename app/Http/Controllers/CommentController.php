<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class CommentController extends Controller
{
    public function commentable()
    {
        return $this->morphTo();
    }
//    public function store(Request $request)
//    {
//        // Validate the request data
//        $request->validate([
//            'content' => 'required',
//            'post_id' => 'required|exists:posts,id',
//        ]);
//
//        $comment = new CommentController();
//        $comment->content = $request->input('content');
//        $comment->post_id = $request->input('post_id');
//
//        $comment->save();
//
//        return redirect()->back()->with('success', 'CommentController added successfully');
//    }
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'content' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment(); // Create a new instance of the Comment model
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->commentable_type = 'App\Post'; // Replace 'App\Post' with the appropriate commentable model
        $comment->commentable_id = $request->input('post_id'); // Assuming the commentable_id is the same as the post_id
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully');
    }

}
