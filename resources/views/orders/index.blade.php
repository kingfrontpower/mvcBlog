@extends('main')

@section('title',' | 顯示訂單')

@section('myStyleSheet')
<style>
    .my-background-color{
        background-color: #eee; 
    }
</style>
@endsection


@section('content')

<div class="row">
    <div class="col-md-12 my-background-color" >       
        <table class='table table-striped'>
            <thead>
                <th height="30">訂單日期</th>
                <th>收件人名</th>
                <th>聯絡電話</th>
                <th>地址</th>
                <th>水梨級別</th>               
                <th>數量</th>               
                <th>禮盒</th>               
                <th>已出貨</th>

            </thead>
            <tbody>

                @foreach($orders as $order)
                <tr >
                    <td >{{ $order->created_at }}</td>
                    <td >{{ $order->order_user_name }}</td>
                    <td>{{ $order->telphone }}</td>
                    <td>{{ $order->addr }}</td>
                    <td>{{ $order->order_level }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td></td> 
                    <td>{{ $order->shipping }}</td> 

                </tr>
                <tr>
                    <td colspan="8" >(訂單編號#{{ $order->id }})留言內容</td> 
                </tr>
                <tr>
                    <td colspan="8" height="150">{{ $order->message_board }}</td> 
                </tr>
                @endforeach

            </tbody>
        </table> 
        <div class="text-center">

        </div>      
    </div>    
</div>
<br>
@endsection