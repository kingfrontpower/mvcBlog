@extends('main')

@section('title','| 忘記密碼')

@section('content')

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
         <div class="panel panel-default">
             <div class="panel-heading">請輸入註冊時的密碼</div>
             <div class="panel-body">
               @if(session('status'))
                  <div class="alert alert-success">{{ session('status') }}</div>
                   
               @endif
               
                {!! Form::open(['url'=>'password/email','method'=>'POST']) !!}
                 {{ Form::label('email','電子郵件') }}
                 {{ Form::email('email', null, ['class'=>'form-control']) }}
                 {{ Form::submit('重設密碼',['class'=>'btn btn-primary form-spacing-top btn-block'])}}
                 {!! Form::close() !!}
                 
             </div>
         </div>
        </div>
    </div>

@endsection