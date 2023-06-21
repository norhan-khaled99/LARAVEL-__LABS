@extends('layouts.app')

@section('title')
    Create Post
@endsection

@section('content')
    <h1 class="text-center">Create Post</h1>
    <div class="row justify-content-center my-3">
        <div class="col-md-6">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{route('post.store')}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <h3>Title</h3>
                    @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <input type="text" class="form-control" value="{{old('title')}}" name="title">
                </div>

                <div>
                    <h3>Description</h3>
                    @error('description')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <input type="text" class="form-control" value="{{old('description')}}" name="description">
                </div>

{{--                <div>--}}
{{--                    <h3>Post Creator</h3>--}}
{{--                    @error('creator')--}}
{{--                    <div class="alert alert-danger">{{$message}}</div>--}}
{{--                    @enderror--}}
{{--                    <select name="creator" id="creator">--}}
{{--                        @foreach ($users as $user)--}}
{{--                            <option value="{{ $user->id }}">{{ $user->name }}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
{{--                </div>--}}

                <select name="user_id" id="postedby">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>


                <div>
                    <h3>Post Image</h3>
                    @error('`image')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    <input type="file" class="form-control" name="image">
                </div>

{{--                <div>--}}
{{--                    <h3>Comment</h3>--}}
{{--                    @error('comment_body')--}}
{{--                    <div class="alert alert-danger">{{$message}}</div>--}}
{{--                    @enderror--}}
{{--                    <textarea name="comment_body" id="comment_body" rows="3" required>{{ old('comment_body') }}</textarea>--}}
{{--                </div>--}}

                <div class="d-block mx-auto my-3 text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
