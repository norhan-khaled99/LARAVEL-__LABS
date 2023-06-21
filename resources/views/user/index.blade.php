@extends('layout.app');
@section('title')
    ALL Posts from Database
@endsection

{{--@dd($posts);--}}
@section('body')
    <div class="container">
        <h1 class="text-center my-5">All Users</h1>

        <table class="table">
            <tr>
                <td>id</td> <td>name</td> <td>email</td>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    {{-- <td><a href="{{route('post.show',$post->id)}}" class="btn btn-info">show</a></td> --}}
                    {{-- <td><button class="btn btn-warning">Edit</button></td> --}}
                    {{-- <td><button class="btn btn-danger">Delete</button></td> --}}
                </tr>
            @endforeach
        </table>
{{--        {{ $users->links() }} <!-- Display pagination links -->--}}
        <div class="d-flex justify-content-center">
            <div class="pagination">
                {{ $users->onEachSide(5)->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection
