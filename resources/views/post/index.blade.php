@extends('layouts.app')
@section('title')
    ALL Posts from Database
@endsection

{{--@dd($posts);--}}
@auth()
     <h1 class="text-center">welcome {{Auth::user()->name}}</h1>
@endauth
@section('content')
<div class="container">
<h1 class="text-center">All posts</h1>

   <div class="mx-auto w-75">
    <div class="input-group">
        <input class="form-control col-8" type="search" placeholder="search"
               id="search">
    </div>
   </div>

    <table class="table">
    <tr>
        <td> id</td> <td> Title</td>   <td>Slug</td>  <td>posted by</td> <td> created At</td>,<td>image</td> <td>show</td>  <td>edit</td> <td>delete</td>
        @foreach($posts as $post)
{{--            @dd($post->user['name'])--}}
            <tr>
                <td>
                    {{$post->id}}
                </td>
                <td>
                    {{$post->title}}
                </td>
                <td>{{ $post->slug }}</td>
                <td>
                    @if(isset($post->user['name']))
                    {{$post->user['name']}}
                    @endif
                </td>
                <td>
{{--                    {{$post->created_at}}--}}
{{--                    {{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d')}}--}}
                </td>
{{--                <td>{{$post->image}}</td>--}}
                <td> <img width="100" height="100" src="{{asset('images/posts/'.$post->image)}}"></td>

                <td><a  href="{{route('post.show',$post->id)}}" class="btn btn-info">show</a></td>
                <td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-warning">Edit</a></td>
                <td>
               <form method="POST" action="{{ route('post.destroy', $post) }}" onsubmit="return confirm('Are you sure you want to delete this post?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
                </form>
                </td>
            </tr>
        @endforeach

    </tr>

</table>
{{--    <div class="d-flex justify-content-center">--}}
{{--        <div class="pagination">--}}
{{--            {{ $posts->links('pagination::bootstrap-5') }}--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="d-flex justify-content-center">
        <td><a href="{{route('post.create')}}" class="btn btn-primary"> create post</a></td>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#search').on('keyup', function () {
            const value = $(this).val();
            $.ajax({
                url: "{{ route('post.search') }}",
                method: 'GET',
                data: {query: value},
                success: function (response) {
                    $('table tbody').html($(response).find('tbody').html());
                }
            });
        });
    });
</script>

@endsection
