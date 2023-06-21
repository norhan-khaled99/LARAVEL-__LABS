@extends('layouts.app')
@section('title')
    ALL Posts from Database
@endsection

{{--@dd($posts);--}}
@section('content');
{{--    <h1>{{$post->id}}Title</h1>--}}
    <div class="card mx-auto" style="width:18rem">
        <img src="{{asset('images/posts/'.$post->image)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
            <td>
             @can('update-post',$post ,Auth::user())
            <a href="{{route('post.edit',$post->id)}}" class="btn btn-warning">eidt posts</a>
            @endcan
            </td>



            <!-- CommentController Form -->
            <h2>Add Comment</h2>
            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <input type="hidden" name="commentable_type" value="App\Models\Post">
                <input type="hidden" name="commentable_id" value="{{ $post->id }}">
                <div>
                    <label for="content">Comment:</label>
                    <textarea name="content" id="body" cols="30" rows="3" required></textarea>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>





            <a href="{{route('post.index')}} " class="btn btn-ptimary">back to all posts</a>

        </div>
    </div>
@endsection
