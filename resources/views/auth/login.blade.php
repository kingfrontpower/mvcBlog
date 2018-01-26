@extends('main')

@section('title', '| Login')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        {!! Form::open() !!}

        {{ Form::label('email','電子郵件:') }}
        {{ Form::email('email',null,['class'=>'form-control']) }}
        <!--         <br />-->

        {{ Form::label('password','密碼:')}}
        {{ Form::password('password',['class'=>'form-control']) }}

        <br />

        {{ Form::checkbox('remember') }}
        {{ Form::label('remember','記得帳號密碼')}}

        <br />

        {{ Form::submit('登入',['class' => 'btn btn-primary btn-block'])  }}


        {!! Form::close() !!}

    </div>

    <div class="col-md-6 col-md-offset-3 text-center">
        <br />
        <br />
        <a href="{{ route('register') }}">尚未註冊 | 免費加入會員</a>
      <br />
      
        <a href="{{ url('password/reset') }}">重設密碼</a>
    </div>
</div>

@endsection