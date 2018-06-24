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
        return view('orders.index');

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
        $addTransFee=0;
        //級數的單價
        $levelA=$request->levelA;
        $levelB=$request->levelB;
        $levelC=$request->levelC;
        //  每級的數量      
        $quantity_levelA=$request->quantity_levelA;
        $quantity_levelB=$request->quantity_levelB;
        $quantity_levelC=$request->quantity_levelC;
        $quantity_total=$quantity_levelA+$quantity_levelB+$quantity_levelC;
        //商品的內容
        $myLevel=array(0=>'新興_6粒8斤_每盒'.$levelA.'元',1=>'新興_8粒8斤_每盒'.$levelB.'元',2=>'新興_10粒8斤_每盒'.$levelC.'元');
        //數量的陣列
        $quantity_array=array(0=>$quantity_levelA,1=>$quantity_levelB,2=>$quantity_levelC);
        //   級數單價 的陣列     
        $level_price_array=array(0=>$levelA,1=>$levelB,2=>$levelC);

        //                print_r($myLevel);
        //               echo $myLevel[2];
        //               echo $quantity_array[0];
        //         return $request;
        //        exit;

        //validate the data
        $this->validate($request, array(
            'order_user_name' => 'required|max:25',
            'telphone' => 'required|max:12',                    
            'addr' => 'required|max:255',


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
        //rowid=年月日時分秒.user_id.telphone
        $order->order_id = trim($request->order_id)."_".trim($request->telphone);
        $order->created_at = $request->created_at;

        $order->save();
        if($quantity_total<=1) {$addTransFee=100;}
        for($i=0;$i<=2;$i++){
            if($quantity_array[$i] >0){
                $item = new Item;
                $item->order_level = $myLevel[$i];
                $item->quantity = $quantity_array[$i];
                $item->price = $level_price_array[$i] * $quantity_array[$i];
                $item->box = $request->box;
                $item->order_id = trim($request->order_id)."_".trim($request->telphone);
                $item->created_at = $request->created_at;

                $item->save(); 

            }
        }

        // 'Flash' exists for one page request
        // 'Put' exists until the session is removed
        $mymessage="訂購資訊為: _1.收件人:".$request->order_user_name ."_";
        $mymessage.=" 2.聯絡電話:".$request->telphone ."_";
        $mymessage.=" 3.收件地址:".$request->addr ."_";
        $mymessage.=" 4.商品內容:_";

        for($i=0;$i<=2;$i++){
            if($quantity_array[$i] >0){                       
                $mymessage.=" 水梨等級:". $myLevel[$i] ."_";
                $mymessage.=" 數量:". $quantity_array[$i] ."_";
            }
        }

        $mymessage.=" 7禮盒:".$request->box ."_";
        $mymessage.=" 8.留言:".$request->message_board ."_";
        $mymessage.=" 感謝您的訂購,離開頁面或重整網後,將不再顯示此筆資料,歡迎加入會員以查詢訂單明細.";

        if(Auth::check()){
            Session::flash('success', '感謝您，您已成功填寫訂購單!');      
            //redirect to another page
            return redirect()->route('orders.index', $order->id); 
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
        //        $order_query.="and a.order_id = b.order_id ";
        //        $order_query.="and a.id= ".$id;        

        $order = Order::find($id); 
        $order_id=$order->order_id;
        //        $item = Item::where('rando_no',$order->rando_no)->where('created_at',$order->created_at)->orderBy('created_at', 'desc')->get(); 

        //         $thisUserId=Auth::user()->id;
        $order_query="SELECT * from items a 
left JOIN orders b on a.order_id = CONVERT(b.order_id USING utf8) COLLATE utf8_unicode_ci ";
        $order_query.="where a.id=".$order_id;
        $orders = DB::select($order_query); 

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

    public function service_orders()
    {
        $thisUserId=Auth::user()->id;
        $orders_query="SELECT a.*";
        $orders_query.="FROM  orders a   ";        
        $orders_query.="where a.order_user_id=' ".$thisUserId."' ";
        $orders = DB::select($orders_query);
        return $orders;
    }

    public function service_items()
    {
        $thisUserId=Auth::user()->id;
        $items_query="SELECT * FROM  items  ";
        $items = DB::select($items_query);
        return $items;
    }


}
