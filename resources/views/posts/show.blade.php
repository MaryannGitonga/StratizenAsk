@extends('layouts.app')

@section('content')
    <div class="container">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="font-weight-bold mb-3">Title: {{ $post->title }}</h5>
                    <p class="mb-0">Description: {{ $post->detail }}</p>
                    <p class="mb-0">Faculty: {{ $post->category }}</p>
                    <p class="mb-0">Author: {{  $author->name  }} </p>

                @if (count($post->tags)>0) 
                    <p class="mb-0">Tags:</p>
                    <ul class="list-group list-group-horizontal">
                        @foreach ($post->tags as $tag)
                            <li class="list-group-item p-2 border-0"><a href="{{ route ('show',['tag' => $tag] ) }}">{{$tag->name}}</a></li>
                        @endforeach
                    </ul>
                @endif

                    @role('administrator')
                    <p class="mb-0">Status: {{ $post->status }}</p>
                    @endrole
                </div>
                <div class="card-body" >
                    @guest
                        <a href="{{ route('posts.index') }}" class="card-link" style="color: #4B94FD;">Back</a>
                    @else
                        @if (Auth::user()->id == $author->id)
                            <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                <a class="card-link" href="{{ route('posts.edit',$post->id) }}"style="color: #4B94FD;">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn card-link" style="color: #4B94FD;">Delete</button>
                                    <a href="{{ route('posts.index') }}" class="card-link" style="color: #4B94FD;">Back</a>
                            </form>
                        @else
                            @role('administrator')
                                <a class="card-link" href="{{ route('update_status',$post->id) }}"style="color: #4B94FD;">Change Status</a>
                                <a href="{{ route('index_admin') }}" class="card-link" style="color: #4B94FD;">Back</a>
                            @endrole
                            @role('lecturer')
                                <a class="card-link" href="{{ route('close_post',$post->id) }}"style="color: #4B94FD;">Close Post's Discussion</a>
                                <a href="{{ route('posts.index') }}" class="card-link" style="color: #4B94FD;">Back</a>
                            @endrole
                        @endif
                    @endguest
                </div>
        </div><br>
        @if ($post->closed_on == null)
            <div class="comment-form">
                <form action="{{ route('comments_store',$post->id) }}" method="GET">
                        <div class="col-md-12">
                            <label for="comment"><strong>Join the Discussion</strong></label>
                            <textarea class="form-control" style="height:100px; width:700px;" name="comment" placeholder="Tell us what you think"></textarea>
                        </div> <br>
                        <div class="col-md-12 pt-3">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                        </div>
                </form>
            </div><br>
        @else
            <div class="alert alert-primary">
                <p>This discussion is already closed. You cannot contribute. Please view the existing comments.</p>
            </div><br>
        @endif
        <div class="row">
        
            <div class="col-md-8 col-md-offset-2">           
            <h3><i class="fas fa-comments" style="color: #227DC7"></i>  Comments</h3>
                @foreach ($comments as $comment)
                    <div class="comment">
                        @if (Auth::user()->id == $comment->user_id)
                            <img src="{{ Storage::url('uploads/avatars/'. Auth::user()->id . '/' . Auth::user()->avatar . '') }}" class="rounded-circle pb-1 pr-1" style="height:30px;width:30px;float:left;" alt=""  onerror="this.src='uploads/avatars/avatar.png';">
                            <p style="margin-bottom:0px;"><strong> You </strong> said...</p>
                        @else
                        <img src="{{ Storage::url('uploads/avatars/'. $comment->user_id . '/' . $comment->avatar . '') }}" class="rounded-circle pb-1 pr-1" style="height:30px;width:30px;float:left;" alt=""  onerror="this.src='uploads/avatars/avatar.png';">
                            <p style="margin-bottom:0px;"><strong>{{ $comment->author }} </strong> said...</p>
                        @endif
                            <p style="color: #A8A8A8; font-size:12px;margin-bottom:0px;">on {{ $comment->updated_at }}</p>
                            <p style="margin-bottom:0px;">{{ $comment->comment }}</p><br>   
                            @if (Auth::user()->id == $comment->user_id)
                                    <form action="{{ route('comments.destroy',$comment->id) }}" method="POST">
                                    <a class="card-link" href="{{ route('comments.edit',$comment->id) }}"style="color: #4B94FD;">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn card-link" style="color: #4B94FD;">Delete</button>
                                    </form>
                
                            @else

                            @endif
                        </>
                    </div>
                @endforeach
            </div>
           
        </div>

        {!! $comments->links() !!}
        </div>
@endsection