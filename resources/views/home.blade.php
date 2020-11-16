@extends('layouts.app')
@section('content')
    <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @foreach ($posts as $post)
    <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3">Title: {{ $post->title }}</h5>
                    <p class="mb-0">Description: {{ $post->detail }}</p>
                    <p class="mb-0">Category: {{ $post->category }}</p>
                    @if (count($post->tags)>0)
                        <p class="mb-0">Tags:</p>
                        <ul class="list-group-horizontal">
                            @foreach ($post->tags as $tag)
                                <li class="list-group-item"><a href="{{ route ('show',['tag' => $tag] ) }}">{{$tag->name}}</a></li>
                            @endforeach
                        </ul>
                    @endif
                    <p class="mb-0">Published on: {{ $post->published_on }}</p>
                </div>
                <div class="card-body">
                    <a href="{{ route('posts.show',$post->id) }}" class="card-link">View</a>
                </div>
    </div><br>

    @endforeach
    {!! $posts->links() !!}
</div>
@endsection