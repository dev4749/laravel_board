@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">title</th>
                <th scope="col">content</th>
                <th scope="col">category</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postList as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td><a href="{{route('post.show', $post->id)}}">{{$post->title}}</a></td>
                    <td>{{$post->content}}</td>
                    <td>{{$post->category}}</td>
                    <td>{{$post->user->name}}</td>
                    <td>{{$post->user->email}}</td>
                    <td>{{$post->created_at}}</td>
                    <td>{{$post->updated_at}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $postList->links() }}
    </div>
@endsection
