@extends('main')

@section('title', '| Register')

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            {!! Form::open() !!}

            {{ Form::label('name','姓名:') }}
            {{ Form::text('name',null,['class'=>'form-control']) }}

            {{ Form::label('email','電子郵件:') }}
            {{ Form::email('email',null,['class'=>'form-control']) }}
            <!--         <br />-->

            {{ Form::label('password','密碼:')}}
            {{ Form::password('password',['class'=>'form-control']) }}

            {{ Form::label('password_confirmation','確認密碼:')}}
            {{ Form::password('password_confirmation',['class'=>'form-control']) }}


            {{ Form::submit('註冊',['class' => 'btn btn-primary btn-block form-spacing-top'])  }}

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection