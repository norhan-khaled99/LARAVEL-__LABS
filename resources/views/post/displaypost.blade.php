<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

@extends('layouts.app')

@section('title')
display post
@endsection
@section('body')


    <table class="table">
        <tr>
            <td> id</td> <td> Title</td> <td>posted by</td> <td> created At</td> <td>Actions</td>
        </tr>

        @foreach($posts as $post)
            <tr>
                <td> {{$post["id"]}}</td>
                <td> {{$post["title"]}}</td>
{{--                <td> {{$post->user["name"]}}</td>--}}
                <td> {{$post->user->id}}</td>

                <td> {{$post["createat"]}}</td>
                     <button class="btn btn-light">view</button>
                    <button class="btn btn-primary">edit</button>
                    <button class="btn btn-danger">delete</button>
{{--                </td>--}}
            </tr>
        @endforeach
    </table>

@endsection
