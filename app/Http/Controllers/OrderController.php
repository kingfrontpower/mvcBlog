<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;

use App\User;

use App\Item;

use Session;

use Auth;

use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $thisUserId=Auth::user()->id;
        $order_query="SELECT a.*,b.order_level,b.quantity ,b.price ";
        $order_query.="FROM items b, orders a ";
        $order_query.="where a.created_at=b.created_at ";
        $order_query.="and a.rand_no = b.rand_no ";
        $order_query.="and a.order_user_id=' ".$thisUserId."' ";   

        //        $orders = Order::where('order_user_id', $thisUserId)->orderBy('id','DESC')->paginate(1);
        $orders = DB::select($order_query);

        //        $items = Item::where('rando_no',$orders->rando_no)->where('created_at',$orders->created_at)->orderBy('created_at', 'desc')->get(); 
        
    
        return view('orders.index')->withOrders($orders);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        return $request;
        $myLevel=array('1000'=>'新興_6粒8斤_每盒1000元','800'=>'新興_8粒8斤_每盒800元','600'=>'新興_10粒8斤_每盒600元');
        //        print_r($myLevel);
        //        echo $myLevel[$request->order_level];

        //validate the data
        $this->validate($request, array(
            'order_user_name' => 'required|max:25',
            'telphone' => 'required|max:12',                    
            'addr' => 'required|max:255',
            'order_level' => 'required|max:55|',
            'quantity' => 'required|max:25',
            'box' => 'required|max:25', 
            'price' => 'required|max:6', 
            'message_board' => 'max:255'           
        ));

        //store in database
        $order = new Order;

        $order->order_user_name = $request->order_user_name;
        $order->telphone = $request->telphone;
        $order->addr = $request->addr;

        $order->message_board = $request->message_board;
        $order->order_user_id = $request->order_user_id;
        $order->rand_no = $request->rand_no;
        $order->created_at = $request->created_at;

        $order->save();

        $item = new Item;
        $item->order_level = $myLevel[$request->order_level];
        $item->quantity = $request->quantity;
        $item->price = $request->price;
        $item->box = $request->box;
        $item->rand_no = $request->rand_no;
        $item->created_at = $request->created_at;

        $item->save();        

        // 'Flash' exists for one page request
        // 'Put' exists until the session is removed
        $mymessage="訂購資訊為: ___1.收件人:".$request->order_user_name ."___";
        $mymessage.=" 2.聯絡電話:".$request->telphone ."___";
        $mymessage.=" 3.收件地址:".$request->addr ."___";
        $mymessage.=" 4.水梨等級:".$myLevel[$request->order_level] ."___";
        $mymessage.=" 5.數量:".$request->quantity ."___";
        $mymessage.=" 6.價格:".$request->price ."___";
        $mymessage.=" 7禮盒:".$request->box ."___";
        $mymessage.=" 8.留言:".$request->message_board ."___";
        $mymessage.=" 感謝您的訂購,離開頁面或重整網後,將不再顯示此筆資料,歡迎加入會員以查詢訂單明細.";

        if(Auth::check()){
            Session::flash('success', '感謝您，您已成功填寫訂購單!');      
            //redirect to another page
            return redirect()->route('orders.show', $order->id); 
        }else{
            Session::flash('success', $mymessage); 
            return redirect()->route('orderIndexNoLogin');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //        $order_query="SELECT a.*,b.order_level,b.quantity ,b.price ";
        //        $order_query.="FROM items b, orders a ";
        //        $order_query.="where a.created_at=b.created_at ";
        //        $order_query.="and a.rand_no = b.rand_no ";
        //        $order_query.="and a.id= ".$id;        

        $order = Order::find($id);  
        $item = Item::where('rando_no',$order->rando_no)->where('created_at',$order->created_at)->orderBy('created_at', 'desc')->get();  
        return  $order;
        exit;
        //        return view('orders.show')->withOrder($order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function orderIndexNoLogin()
    {
        return view("orders.orderIndexNoLogin");
    }


}
