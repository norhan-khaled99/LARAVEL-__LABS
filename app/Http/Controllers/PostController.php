<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PostRequest;
use App\Rules\MaxPostsAllowed;
use Illuminate\Support\Facades\Storage;


class  postController extends Controller
{

    function createpost()
    {
        $users = User::all();
        return view('post.createpost', compact('users'));

//        return view('post.createpost');
    }
    function displaypost ()
    {
//     $posts=[
//         ['id'=>1,'title'=>'learn php','postedby'=>'ahmed', 'createat'=>'2018-4-10'],
//         ['id'=>2,'title'=>'learn php','postedby'=>'mohamed', 'createat'=>'2018-5-10'],
//         ['id'=>3,'title'=>'learn php','postedby'=>'ali', 'createat'=>'2018-6-10'],         ];
//        return view("postController.displaypost", ['posts'=>$posts]);
//    }
    }

    function index( )
    {
        $posts = post::all();
        $posts=Post::paginate(50);
        return view('post.index', ['posts' => $posts]);
    }


    public function search(Request $request)
    {
        $searchTerm = $request->get('query');
        $posts = Post::where('title', 'LIKE', '%' . $searchTerm . '%')->get();
        return view('post.index', ['posts' => $posts]);
    }

//    function show($id)
//    {
//        $post=Post::where('id',$id)->first();
//        return view('post.show',['post'=>$post]);
//    }
//    function save()
//    {
//        request()->validate(
//            [
//            'title' => 'required',
//            'description' => 'required',
//            'postedby' => 'required',
//        ]);
//
//        $post_info = request()->all();
//        $post = new Post();
//        $post->title = $post_info['title'];
//        $post->description = $post_info['description'];
//        $post->postedby = $post_info['postedby'];
//        $post->save();
//
//        return redirect()->route('post.index');
//    }
////
////    function save()
////    {
////        $post_info=request()->all();
////        $post=new Post();
////        $post->title=$post_info['title'];
////        $post->description=$post_info['description'];
////        $post->postedby=$post_info['postedby'];
////        $post->save();
////        return to_route('post.index');
////
////    }
//    function destroy($id)
//    {
//        $post=Post::findOrfail($id);
//        $post->delete();
//        return to_route('post.index');
//    }
//    public function update($id)
//    {
//        $post = Post::findOrFail($id);
//        $post->update(request()->all());
//        return redirect()->route('post.index');
//    }
//    public function edit($id)
//    {
//        $post = Post::findOrFail($id);
//        return view('post.editpost',['post'=>$post]);
//    }
        function __construct()
        {
            $this->middleware('auth')->only('store','update','destroy');
        }
//     public function create()
//     {
//         $posts = Post::paginate(10); // Change the number (10) to the desired number of posts per page
//         return view('post.createpost', compact('posts'));
//     }
    public function create()
    {
        $users = User::all();
        return view('post.createpost', compact('users'));
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'unique:posts', new MaxPostsAllowed()],
            'description' => 'required|min:10',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.unique' => 'The title has already been taken.',
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must be at least :min characters.',
        ]);

        $user = auth()->user();

        if ($user) {
            if ($user->posts()->count() >= 3) {
                return redirect()->back()->withErrors('You have reached the maximum allowed number of posts.');
            }
            $post = new Post();
            $post->title = $request->input('title');
            $post->user_id = $request->input('user_id');

            $post->description = $request->input('description');
//            $post->user_id = $user->id;

            if ($request->hasFile('image')) {
//                dd("ay bentagn");
                $image_name = time() . '.' . $request->file('image')->extension();
                $request->file('image')->move(public_path('/images/posts'), $image_name);
                $post->image = $image_name;
            }
//            dd($post->image);
            $post->save();
        }

        return redirect()->route('post.index');
    }



//    public function show(Post $post)
//     {
//         return view('post.show',['post'=>$post]);
//     }

    public function show(Post $post)
    {
        $post->load('comments.user');

        return view('post.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('post.editpost', compact('post', 'users'));
    }



//    public function update(Request $request, Post $post)
//    {
//        if ($request->user()->cannot('update', $post)) {
////            abort(403);
//        }
//
//        $request->validate([
//            'title' => 'required|min:3|unique:posts,title,' . $post->id,
//            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
//        ], [
//            'title.required' => 'The title field is required.',
//            'title.min' => 'The title must be at least :min characters.',
//            'title.unique' => 'The title has already been taken.',
//            'image.image' => 'The file must be an image.',
//            'image.mimes' => 'Only JPEG and PNG images are allowed.',
//            'image.max' => 'The image size must not exceed 2MB.',
//        ]);
//
//        $old_image = $post->image;
//
//        $post->title = $request->input('title');
//
//        if ($request->hasFile('image')) {
//            // Delete old image
//            if ($old_image != 'post.png') {
//                Storage::disk('public')->delete('images/posts/' . $old_image);
//            }
//
//            // Store new image
//            $image_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
//            $request->file('image')->storeAs('images/posts', $image_name, 'public');
//
//            $post->image = $image_name;
//        }
//
//        $post->save();
//
//        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully.');
//    }

    public function update(Request $request, Post $post)
    {
        if ($request->user()->cannot('update', $post)) {
//            abort(403);
        }
        $request->validate([
            'title' => 'required|min:3|unique:posts,title,' . $post->id,
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ], [
            'title.required' => 'The title field is required.',
            'title.min' => 'The title must be at least :min characters.',
            'title.unique' => 'The title has already been taken.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'Only JPEG and PNG images are allowed.',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);

        $old_image = $post->image;

        $post->title = $request->input('title');
        $post->user_id = $request->input('user_id');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($old_image != 'post.png') {
                Storage::disk('public')->delete('images/posts/' . $old_image);
//                dd("ay betngan");

            }
            dd($post->image);
            // Store new image
            $image_name = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('images/posts', $image_name, 'public');

            $post->image = $image_name;
        }
        $post->save();
        return redirect()->route('post.show', $post->id)->with('success', 'Post updated successfully.');
    }



    public function destroy(Post $post)
    {
        if (Gate::allows('delete-post',$post))
            {
                abort(403);
            }
        $this->deleteImage($post);
        $post->delete();
        return to_route('post.index');
    }

    private  function  deleteImage(Post $post){
        if($post->image !='post.png'){
            try{
                unlink(public_path('images/posts/'.$post->image));
            } catch (Exception $e){

            }
        }
    }

    function get_posts(){
        $posts=Post::all();
        return $posts;
    }

}
