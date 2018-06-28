@extends('main')

@section('title',' | 雲端訂購單')

@section('myStyleSheet')
<style>
    .myCoverPearImg {  
        width:100%;
        margin-top: 15px;

    }
    .row-margin-top{
        margin-top: -20px;

    }

</style>
@endsection

@section('content')
<div class="container"> 
    <div class="row row-margin-top">
        <div class="col-md-10  col-md-offset-1 myBackgroundColor">
            <!--
<div class="jumbotron ">
<h1>Welcome to My Blog!</h1>
<p class='lead'>Thank you so much for visiting. This is my test website built with Laravel. Please read my popular post!</p>
<p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
</div>

-->
            <img class="myCoverPearImg" src="images/pear_07.jpg" alt="首頁照片">
        </div>
        <div class="col-md-10  col-md-offset-1 myBackgroundColor">
            <div class="col-md-12 ">

                {!! Form::open(['route' => 'orders.store','data-parsley-validate' => '']) !!}

                <table class="table">
                    <tr>
                        <th colspan="2"><h1 class="text-deep-green">官人我要-新增雲端訂購單</h1></th>

                    </tr>
                    <tr>
                        <td>{{ Form::label('order_user_name','姓名:') }}</td>
                        <td>{{ Form::text('order_user_name', null ,array('class' => 'form-control', 'required' => 'required' ,'maxlength' => '125')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('telphone','聯絡電話:') }}</td>
                        <td>{{ Form::text('telphone', null ,array('class' => 'form-control', 'required' => 'required','minlength' =>'5' ,'maxlength' => '125')) }}</td>
                    </tr>

                    <tr>
                        <td>{{ Form::label('addr', '地址:') }}</td>
                        <td>{{ Form::text('addr', null,array('class' => 'form-control', 'required' => 'required')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('order_level', '等級:') }}</td>
                        <td> {{ Form::select('order_level', array('新興_6粒_8斤' => '新興_6粒_8斤','新興_8粒_8斤' => '新興_8粒_8斤', '新興_10粒_8斤' => '新興_10粒_8斤'), '請用禮盒包裝',array('class' => 'form-control')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('quantity', '箱數:') }}</td>
                        <td>{{ Form::text('quantity', null,array('class' => 'form-control', 'required' => 'required')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('box', '是否要禮盒包裝:') }}</td>
                        <td>{{ Form::select('box', array('請用禮盒包裝' => '請用禮盒包裝', '不用禮盒,謝謝' => '不用禮盒,謝謝'), '請用禮盒包裝',array('class' => 'form-control')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('message_board', '留言板:') }}</td>
                        <td>{{ Form::textarea('message_board', null,array('class' => 'form-control', 'rows' => '3')) }}</td>
                    </tr>
                    <tr>
                        <td colspan="2"> {{ Form::submit('Create Post', array('class' => 'btn  btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}</td>
                    </tr>
                </table>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div><!-- end of header.row -->

@endsection

@section('myJavaScript')
<script>
    //confirm('js is ran on this page!');
</script>
@endsection


