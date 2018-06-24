@extends('main')

@section('title', '| Login')

@section('myStyleSheet')
<style>
/*
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
    }
*/
    .myCoverPearImg {  
        width:100%;
    }
</style>
@endsection


@section('content')

<div class="row">
    <div class="col-md-9">
        <img class="myCoverPearImg" src="{{url('/')}}/images/pear_07.jpg" alt="首頁照片">
    </div>
    <div class="col-md-3 ">
        {!! Form::open() !!}

        {{ Form::label('email','帳號:') }}
        {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'請輸入電子郵件,例如:abc@gmail.com',]) }}
        <!--         <br />-->

        {{ Form::label('password','密碼:')}}
        {{ Form::password('password',['class'=>'form-control']) }}

        <br />

        {{ Form::checkbox('remember') }}
        {{ Form::label('remember','記得帳號密碼')}}

        <br />

        {{ Form::submit('登入',['class' => 'btn btn-primary btn-block'])  }}


        {!! Form::close() !!}
        <br />
        <a  class="btn btn-success btn-block" href="{{ route('register') }}" style="color:#222;">尚未註冊 | 免費加入會員</a>
        <br />

        <a class="btn btn-success  btn-block" href="{{ url('password/reset') }}" style="color:#222;">重設密碼</a>

    </div>

    <div class="col-md-6 col-md-offset-3 text-center">
        <br />
        
    </div>
</div>

@endsection