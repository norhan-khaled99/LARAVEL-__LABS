<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\StorePostRequest;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\PostResource;
use Illuminate\Session\Store;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function contruct(){
        $this->middleware('auth:sanctum')->only(['store','update','delete']);
    }

    public function index()
    {
        return PostResource::collection(Post::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $post=Post::create($request->all());
        $this->save_image($request->image,$post);
//        return new Response($post,201 );
        return new Response(new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post) {
//            return $post;
            return new PostResource($post);
        }
        return new Response('',205);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return new Response(new PostResource($post));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return new Response('',204);
    }

    private  function  delete_image($image_name){
//        dd($image_name !='article.png' and ! str_contains($image_name, '/tmp/'));
        if($image_name !='post.png' and ! str_contains($image_name, '/tmp/')){
            try{
                unlink(public_path('images/posts/'.$image_name));

            }catch (\Exception $e){
                echo $e;
            }
        }
    }

    private function save_image($image, $post){
        if ($image){
            $image_name = time().'.'.$image->extension();
            $image->move(public_path('images/posts'),$image_name);
            $post->image = $image_name;
            $post->save();
        }
    }
}
