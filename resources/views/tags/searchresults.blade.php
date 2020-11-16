@extends('layouts.app')

@section('content')
      <form class="form-inline my-2 my-lg-0 justify-content-end">
      <input name="query" id="query" class="form-control mr-sm-2" value="{{ request()->input('query')}}" type="text" placeholder="Search Tags" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
      </form>
<div class="container pl-5 " width="100%">
      <div>
            <h1>Search Results</h1>
      <p>{{ $tags->count()}} result(s) for '{{ request()->input('query')}}'</p>
      </div>
            <div class="mt-4 col-12 pl-5">
            <div class="card-deck">
            @foreach ($tags as $tag)
                        <div class="card-body col-3 shadow-sm border m-2 bg-white">
                        <h3 class="title"><a href="/tags/{{$tag->name}}">{{$tag->name}}</a></h3>
                        <p>{{$tag->description}}</p>
                  </div>
            @endforeach     
      </div>
      <div>
            {{$tags->links()}}
      </div>
</div>


@endsection