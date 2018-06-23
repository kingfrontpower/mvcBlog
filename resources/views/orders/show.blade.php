@extends('main')

@section('title','|檢視訂單')

@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <table>
            <tr>
                <td><h3>收件人姓名：</h3></td>
                <td><h3>{{ $order->order_user_name }}</h3></td>
            </tr>
            <tr>
                <td><h3>聯絡電話：</h3></td>
                <td><h3>{{ $order->telphone }}</h3></td>
            </tr>
            <tr>
                <td><h3>收件地址：</h3></td>
                <td><h3>{{ $order->addr }}</h3></td>
            </tr>
            <tr>
                <td><h3>水梨級別：</h3></td>
                <td><h3>{{ $order->order_level }}</h3></td>
            </tr>
            <tr>
                <td><h3>數量：</h3></td>
                <td><h3>{{ $order->quantity }}</h3></td>
            </tr>
               <tr>
                <td><h3>價格：</h3></td>
                <td><h3>{{ $order->price }}</h3></td>
            </tr>
            <tr>
                <td><h3>禮盒與否：</h3></td>
                <td><h3>{{ $order->box }}</h3></td>
            </tr>
            <tr>
                <td><h3>留言板：</h3></td>
                <td><h3>{{ $order->message_board }}</h3></td>
            </tr>
        </table>

    </div>
</div>
<br>

@endsection