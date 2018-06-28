@extends('main')

@section('title',' | index')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>文章:</h1>
        </div>
    </div>

    @foreach($posts as $post)

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>標題:{{ $post->title }}</h2>
            <h5>建立時間:{{ DATE('m j, Y',strtotime($post->created_at)) }}</h5>
            <p>內文:{{ substr($post->body,0,125) }}{{ strlen($post->body) > 125 ?"...":"" }}</p>
            <a href="{{ route('blog.single',$post->slug) }}" class='btn btn-primary'>Read More</a>
            <hr />
        </div>
    </div>

    @endforeach

    <div class="text-center">
        {{ $posts->links() }}
    </div>   
</div>   

@endsection