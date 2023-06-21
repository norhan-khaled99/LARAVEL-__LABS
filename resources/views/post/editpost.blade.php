@extends('layouts.app')

@section('title')
    display post
@endsection
@section('content')

    <div class="row justify-content-center my-3">
        <div class="col-md-6">
            <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">

{{--            <form method="POST" action="{{ route('post.update', $post->id) }}" >--}}
                @method('PUT')
                @csrf
                <h3>Title</h3>
                <input type="text" class="form-control" name="title" value="{{ $post->title }}" aria-describedby="emailHelp">
                <h3>Description</h3>
                <input type="text" class="form-control" name="description" value="{{ $post->description }}" aria-describedby="emailHelp">
{{--                <h3>Post creator</h3>--}}
{{--                <input type="text" class="form-control" name="postedby" value="{{ $post->postedby }}" aria-describedby="emailHelp">--}}
                <label for="creator">Post Creator</label>
                <select name="user_id" id="creator">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $post->creator ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>

            @if($post->image)
                    <div class="mb-3">
                        <label class="form-label">old image</label>
                        <img src="{{asset('images/pots/'.$post->image)}}">
                    </div>
                @endif
                @if($post->image)

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">post Image</label>
                    <input type="file"
                           name="image" class="form-control" aria-describedby="emailHelp">
                </div>
                @endif
                <div class="d-block mx-auto my-3 text-center">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>

@endsection
