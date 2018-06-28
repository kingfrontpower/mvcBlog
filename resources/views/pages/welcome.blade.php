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
<div class="container"> 
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
                        <td colspan="2">{{ Form::text('order_user_name', null ,array('class' => 'form-control', 'required' => 'required' ,'maxlength' => '25','placeholder' => '王大明先生')) }}
                        </td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('telphone','聯絡電話:') }}</td>
                        <td colspan="2">{{ Form::text('telphone', null ,array('class' => 'form-control', 'required' => 'required','minlength' =>'9' ,'maxlength' => '12','placeholder' => '0953-123-456')) }}</td>
                    </tr>

                    <tr>
                        <td>{{ Form::label('addr', '地址:') }}</td>
                        <td colspan="2">{{ Form::text('addr', null,array('class' => 'form-control', 'required' => 'required','minlength' =>'10' ,'maxlength' => '125','placeholder' => '326桃園市楊梅區中山路168號')) }}</td>
                    </tr>
                    <tr>
                        <!--                    <td><strong>等級:</strong></td>-->
                        <td><strong>新興_6粒_8斤_每盒1000元 </strong></td>

                        <!--                    <td>{{ Form::label('quantity_levelA', '訂購盒數:') }}</td>-->
                        <td colspan="2">{{ Form::select('quantity_levelA', array(0 => '請選擇訂購盒數',1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20), 0,array('class' => 'form-control','onchange'=>'countPrice();')) }}</td>
                    </tr>
                    <tr>
                        <!--                    <td><strong></strong></td>-->
                        <td><strong>新興_8粒_8斤_每盒800元</strong> </td>

                        <!--                    <td>{{ Form::label('quantity_levelB', '訂購盒數:') }}</td>-->
                        <td colspan="2">{{ Form::select('quantity_levelB', array(0 => '請選擇訂購盒數',1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20), 0,array('class' => 'form-control','onchange'=>'countPrice();')) }}</td>
                    </tr>
                    <tr>
                    <tr>
                        <!--                    <td><strong></strong> </td>-->
                        <td><strong>新興_10粒_8斤_每盒600元</strong>  </td>

                        <!--                    <td>{{ Form::label('quantity_levelC', '訂購盒數:') }}</td>-->
                        <td colspan="2">{{ Form::select('quantity_levelC', array(0 => '請選擇訂購盒數',1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20), 0,array('class' => 'form-control','onchange'=>'countPrice();')) }}</td>
                    </tr>



                    <tr>
                        <td ></td>
                        <td colspan="2" style="color:green;">*同一收件地址訂購兩盒以上免運費,單盒加收運費100元</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('price', '商品及貨到付款費用總計:') }}</td>
                        <td colspan="2">{{ Form::text('price', '0' ,array('class' => 'form-control', 'required' => 'required','maxlength' => '6', 'readonly' => '')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('box', '是否要禮盒包裝:') }}</td>
                        <td colspan="2">{{ Form::select('box', array('請用禮盒包裝' => '請用禮盒包裝', '不用禮盒,謝謝' => '不用禮盒,謝謝'), '請用禮盒包裝',array('class' => 'form-control')) }}</td>
                    </tr>
                    <tr>
                        <td>{{ Form::label('message_board', '留言板:') }}</td>
                        <td colspan="2">{{ Form::textarea('message_board', null,array('class' => 'form-control', 'rows' => '3','maxlength' => '125','placeholder' => '若要使用其他付款方式, 請加入會員,相關問題, 歡迎留言給我們.謝謝你的訂購.')) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"> {{ Form::submit('送出訂單', array('class' => 'btn  btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
                            <input type="hidden" name="order_user_id" value="@if(Auth::check()){{ Auth::user()->id }}@endif">
                            <input type="hidden" name="order_id" value="{{ date("YmdHis") }}">
                            <input type="hidden" name="created_at" value="{{ date("Y-m-d H:i:s") }}">
                            <input type="hidden" name="levelA" id= "levelA" value="1000">
                            <input type="hidden" name="levelB" id= "levelB" value="800">
                            <input type="hidden" name="levelC" 
                                   id= "levelC" value="600">

                        </td>
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
    function checkForm(){
        var addTransFee=0;

        var quantity_levelA = parseInt(document.getElementById("quantity_levelA").value);
        var quantity_levelB =parseInt( document.getElementById("quantity_levelB").value);
        var quantity_levelC =parseInt( document.getElementById("quantity_levelC").value);
        var levelA =parseInt( document.getElementById("levelA").value);
        var levelB =parseInt( document.getElementById("levelB").value);
        var levelC =parseInt( document.getElementById("levelC").value);

        var myQuantity=quantity_levelA+quantity_levelB+quantity_levelC;
        if (myQuantity<=1){ addTransFee=100;}

        if (myQuantity==0){
            alert("請選擇訂購盒數,謝謝.");return false;
        }

        confirm('確認送出訂單嗎?');
    } 

    function countPrice(){
        var addTransFee=0;

        var quantity_levelA = parseInt(document.getElementById("quantity_levelA").value);
        var quantity_levelB =parseInt( document.getElementById("quantity_levelB").value);
        var quantity_levelC =parseInt( document.getElementById("quantity_levelC").value);
        var levelA =parseInt( document.getElementById("levelA").value);
        var levelB =parseInt( document.getElementById("levelB").value);
        var levelC =parseInt( document.getElementById("levelC").value);

        var myQuantity=quantity_levelA+quantity_levelB+quantity_levelC;
        if (myQuantity<=1){ addTransFee=100;}
        if (myQuantity==0){ addTransFee=0;}

        document.getElementById("price").value=(levelA * quantity_levelA)+(levelB * quantity_levelB)+(levelC * quantity_levelC)+addTransFee;

    }

</script>
@endsection


