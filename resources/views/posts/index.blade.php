@extends('main')

@section('title',' | All Posts')

@section('content')
  <div class="container"> 
<div class="row">

    <div class="col-md-10">
        <h1>所有發表文章</h1>
    </div>
    <div class="col-md-2">
        <a href="{{ route('posts.create') }}" class='btn btn-primary btn-lg btn-h1-spacing'>新增文章</a>
    </div>

    <div class="col-md-12">
        <hr />
    </div>
</div> <!-- end of the row-->

<div class="row">
    <div class="col-md-12">       
        <table class='table'>
            <thead>
                <th>#</th>
                <th>標題</th>
                <th>內文</th>
                <th>建立時間</th>
                <th></th>               
            </thead>
            <tbody>
                @foreach($posts->all() as $post)
                <tr>
                    <th>{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ substr($post->body, 0, 50)  }}{{ strlen($post->body) > 50 ? "..." : "" }}</td>
                    <td>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</td>
                    <td><a href="{{ route('posts.show', $post->id) }}" class='btn btn-default btn-sm'>檢視</a>&nbsp;<a href="{{ route('posts.edit', $post->id) }}" class='btn btn-default btn-sm'>編輯</a></td>                
                </tr>
                @endforeach

            </tbody>
        </table> 
        <div class="text-center">
            {{ $posts->links() }}
        </div>      
    </div>    
</div>
</div>



@endsection