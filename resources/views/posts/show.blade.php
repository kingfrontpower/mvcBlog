@extends('main')

@section('title','|View Posts')

@section('content')

<div class="row">
    <div class="col-md-8">
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->body }}</p>
    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class='dl-horizontal'>
                <lable>Url:</lable>
                <p><a href="{{ route('blog.single',$post->slug) }}">{{ $post->slug }}</a></p>
            </dl>

            <dl class='dl-horizontal'>
                <lable>Create At:</lable>
                <p>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</p>
            </dl>

            <dl class='dl-horizontal'>
                <lable>Last Updated:</lable>
                <p>{{ date('M j, Y h:ia',strtotime($post->updated_at)) }}</p>
            </dl>
            <hr />
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.edit','編輯',array($post->id),array('class'=>'btn btn-primary btn-block')) !!}


                </div>
                <div class="col-sm-6">


                    {!! Form::open(['route' => ['posts.destroy',$post->id],'method'=>'DELETE']) !!}

                    {!! Form::submit('刪除',array('class'=>'btn btn-danger btn-block'))!!}
                    {!! Form::close() !!}

                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Html::linkRoute('posts.index','<< 所有文章', [] ,['class' => 'btn btn-default btn-block btn-h1-spacing']) }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection