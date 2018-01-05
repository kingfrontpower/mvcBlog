@extends('main')

@section('title','|View Posts')

@section('content')

<h1>{{ $post->title }}</h1>
<p>{{ $post->body }}</p>

@endsection