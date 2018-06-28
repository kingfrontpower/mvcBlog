@extends('main')

@section('title',' | Edit Posts')

@section('content')
  <div class="container"> 

<div class="row">
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
    <!-- 假如form::mode少了 , 'method' => 'put' ,將會出現 MethodNotAllowedHttpException -->
    <div class="col-md-8">
        {{ Form::label('title', '標題:') }}
        {{ Form::text('title',null,['class' => 'form-control input-lg'] ) }}
        
        {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
        {{ Form::text('slug',null,['class' => 'form-control'] ) }}

        {{ Form::label('body', '內文:', ['class' => 'form-spacing-top']) }}
        {{ Form::textarea('body',null,['class' => 'form-control'] ) }}


    </div>
    <div class="col-md-4">
        <div class="well">
            <dl class='dl-horizontal'>
                <dt>Create At:</dt>
                <dd>{{ date('M j, Y h:ia',strtotime($post->created_at)) }}</dd>
            </dl>

            <dl class='dl-horizontal'>
                <dt>Last Updated:</dt>
                <dd>{{ date('M j, Y h:ia',strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr />
            <div class="row">
                <div class="col-sm-6">
                    {{ Form::submit('儲存',array('class'=>'btn btn-success btn-block'))  }}

                </div>
                <div class="col-sm-6">

                    {!! Html::linkRoute('posts.show','取消',array($post->id),['class'=>'btn btn-danger btn-block']) !!}

                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
</div>


@endsection