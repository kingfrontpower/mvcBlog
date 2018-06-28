@extends('main')

@section('title','| 重設密碼')

@section('myStyleSheet')
<style>
    footer{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">請輸入新的密碼</div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'password/reset','method'=>'POST']) !!}

                    {{ Form::hidden('token',$token) }}

                    {{ Form::label('email', '電子郵件:') }}
                    {{ Form::email('email', $email, ['class'=>'form-control']) }}

                    {{ Form::label('password','新密碼:') }}
                    {{ Form::password('password',  ['class'=>'form-control']) }}

                    {{ form::label('password_confirmation','確認密碼:')}}
                    {{ Form::password('password_confirmation', ['class'=>'form-control']) }}

                    {{ Form::submit('重設密碼',['class'=>'btn btn-primary form-spacing-top btn-block'])}}
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection