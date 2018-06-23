@extends('main')

@section('title',' | 雲端訂購單')

@section('myStyleSheet')
<style>
    .myCoverPearImg {  
        width:100%;
    }
    .row-margin-top{
        margin-top: -20px;
    }
</style>
@endsection

@section('content')

<div class="row row-margin-top">
    <div class="col-md-10  col-md-offset-1 myBackgroundColor">        
        <img class="myCoverPearImg" src="images/pear_07.jpg" alt="首頁照片">
    </div>
    <div class="col-md-10  col-md-offset-1 myBackgroundColor">
        <div class="col-md-12 ">

            {!! Form::open(['route' => 'orders.store','data-parsley-validate' => '','onsubmit' => 'return checkForm();']) !!}

            <table class="table">
                <tr>
                    <th colspan="2"><h1 class="text-deep-green">官人我要-雲端訂購單</h1></th>

                </tr>
                <tr>
                    <td>{{ Form::label('order_user_name','姓名:') }}</td>
                    <td>{{ Form::text('order_user_name', null ,array('class' => 'form-control', 'required' => 'required' ,'maxlength' => '25','placeholder' => '王小明先生 或 蔡小文小姐')) }}
                    </td>
                </tr>
                <tr>
                    <td>{{ Form::label('telphone','聯絡電話:') }}</td>
                    <td>{{ Form::text('telphone', null ,array('class' => 'form-control', 'required' => 'required','minlength' =>'9' ,'maxlength' => '12','placeholder' => '0953-123-456')) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('addr', '地址:') }}</td>
                    <td>{{ Form::text('addr', null,array('class' => 'form-control', 'required' => 'required','minlength' =>'10' ,'maxlength' => '125','placeholder' => '326桃園市楊梅區大成路168號')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('order_level', '等級:') }}</td>
                    <td> {{ Form::select('order_level',array('1000' => '新興_6粒_8斤_每盒1000元','800' => '新興_8粒_8斤_每盒800元', '600' => '新興_10粒_8斤_每盒600元'), '請用禮盒包裝',array('class' => 'form-control','onchange'=>'countPrice();')) }}</td>
                </tr>

                <tr>
                    <td>{{ Form::label('quantity', '訂購盒數:') }}</td>
                    <td>{{ Form::select('quantity', array(0 => '請選擇盒數',1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20), 0,array('class' => 'form-control','onchange'=>'countPrice();')) }}</td>
                </tr>

                <tr>
                    <td ></td>
                    <td style="color:green;">*同一收件地址訂購兩盒以上免運費,單盒加收運費100元</td>
                </tr>
                <tr>
                    <td>{{ Form::label('price', '商品及貨到付款費用總計:') }}</td>
                    <td>{{ Form::text('price', '0' ,array('class' => 'form-control', 'required' => 'required','maxlength' => '6', 'readonly' => '')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('box', '是否要禮盒包裝:') }}</td>
                    <td>{{ Form::select('box', array('請用禮盒包裝' => '請用禮盒包裝', '不用禮盒,謝謝' => '不用禮盒,謝謝'), '請用禮盒包裝',array('class' => 'form-control')) }}</td>
                </tr>
                <tr>
                    <td>{{ Form::label('message_board', '留言板:') }}</td>
                    <td>{{ Form::textarea('message_board', null,array('class' => 'form-control', 'rows' => '3','maxlength' => '125','placeholder' => '若要使用其他付款方式, 請加入會員,相關問題, 歡迎留言給我們.謝謝你的訂購.')) }}</td>
                </tr>
                <tr>
                    <td colspan="2"> {{ Form::submit('送出訂單', array('class' => 'btn  btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                        <input type="hidden" name="order_user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                        <input type="hidden" name="rand_no" value="{{ rand(10001,99999) }}">
                        <input type="hidden" name="created_at" value="{{ date("Y-m-d H:i:s") }}">

                    </td>
                </tr>
            </table>
            {!! Form::close() !!}

        </div>
    </div>
</div><!-- end of header.row -->

@endsection

@section('myJavaScript')
<script>
    function checkForm(){
        confirm('確認送出訂單嗎?');
    } 

    function countPrice(){
        var myOrderLevel = document.getElementById("order_level").value;
        var myQuantity = document.getElementById("quantity").value;
        var addTransFee=0;
        if (myQuantity<=1){ addTransFee=100;}
        document.getElementById("price").value=(myOrderLevel * myQuantity)+addTransFee;

    }

</script>
@endsection


