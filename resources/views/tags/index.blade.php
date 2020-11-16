@extends('layouts.app')

@section('content')
<div class="p-5">
<div class="px-3 py-3 pt-md-3 pb-md-4 mx-auto pl-5">
      <div class="display-3"><h1>Tags</h1></div>
      <p>Here you can find questions and posts easily using the tags as keywords </p>
</div>
<form action="{{ route('search') }}"class="form-inline my-2 my-lg-0 pl-5">
            <input name="query" id="query" class="form-control mr-sm-2" type="text" placeholder="Search Tags" aria-label="Search">
            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
</form>
<div class="mt-4 card-deck pb-2 pl-5 pr-5">
      @if(count($tags)>1)
      
      @foreach ($tags as $tag)
      <div class="col-3 card-group pb-2 mt-1 ">
                  <div class="card-body border bg-white shadow-sm">
                  <h3 class="card-title"><a href="{{ route ('show',['tag' => $tag] ) }}">{{$tag->name}}</a></h3>
                        <p>{{$tag->description}}</p>
                  </div>
            </div>
      @endforeach 
     @else
            <p>Nothing Found</p>
      @endif   
</div>
<div>
      {{$tags->links()}}
</div>
</div>
@endsection