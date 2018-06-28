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
        return "this is order.index";
    }

    public function getOrderIndex()
    {

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

        for($i=0;$i<=2;$i++){

            if($quantity_array[$i] >0){
                //若是訂單總量只訂一盒,加運費100元
                if($quantity_array[$i]==1 && $quantity_total<=1){$addTransFee=100;}

                $item = new Item;
                $item->order_level = $myLevel[$i];
                $item->quantity = $quantity_array[$i];
                $item->price = (($level_price_array[$i] * $quantity_array[$i]) + $addTransFee);
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
            return redirect()->route('getOrderIndex'); 
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
        return "this is show page.";
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



    public function service_orders()
    {
        $thisUserId=Auth::user()->id;
        $openThisOrder=" where a.order_user_id=".$thisUserId;
        $userLevel=Auth::user()->level;
        if($userLevel=="admin" || $userLevel=="SP"){
            $openThisOrder="";
        }

        $orders_query="SELECT a.*,DATE_FORMAT(created_at,'%Y-%m-%d')order_date ";
        $orders_query.="FROM  orders a  ";        
        $orders_query.= $openThisOrder;
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

    public function orderAdmin()
    {

        return view("orders.orderAdmin");

    }
    public function orderAdminService()
    {
        $userLevel=Auth::user()->level;
        if($userLevel==""){
            Session::flash('danger', '權限不足,無法登入此頁,請聯絡系統管理員.');
            //redirect to another page
            return redirect()->route('home'); 
        }

        //        $orders=DB::table('orders')->orderBy('created_at', 'desc')->get(); 

        $orders_query="SELECT "; 
        $orders_query.="a.*,sum(b.price)total_price, ";
        $orders_query.="sum(b.quantity)total_quantity ";
        $orders_query.="FROM orders a "; 
        $orders_query.="LEFT JOIN items b on a.order_id=b.order_id   ";
        $orders_query.="GROUP BY a.id ORDER BY a.created_at DESC ";
        $orders = DB::select($orders_query);

        $orderArray[0]="";
        $myIndex=0;

        foreach($orders as $order){
            $itemString="";
            $itemIndex=0;

            $items=DB::table('items')->where('order_id','=',$order->order_id)->get();

            foreach($items as $item){
                $itemIndex+=1;
                $itemString.="＊＊＊項目".$itemIndex."內容:_".$item->order_level.",數量:_".$item->quantity.",價格:_".$item->price.",".$item->box."；";
            }
            $makeOrderArray=array("id"=>$order->id,
                                  "order_user_id"=>$order->order_user_id,
                                  "order_user_name"=>$order->order_user_name,
                                  "telphone"=>$order->telphone, 
                                  "addr"=>$order->addr,
                                  "paid"=>$order->paid,
                                  "shipping"=>$order->shipping,
                                  "created_at"=>$order->created_at,
                                  "order_date"=>date("Y-m-d", strtotime($order->created_at)),
                                  "updated_at"=>$order->updated_at,
                                  "message_board"=>$order->message_board,
                                  "order_id"=>$order->order_id,"items"=>$itemString );
            $orderArray[$myIndex]=$makeOrderArray;
            $myIndex+=1;
        }

        return $orderArray;

    }

    //訂單總覽
    public function  getTotalOrderAdmin()
    {
        return view("orders.totalOrderAdmin");
    }

    public function totalOrderAdminService()
    {
        $userLevel=Auth::user()->level;
        if($userLevel==""){
            Session::flash('danger', '權限不足,無法登入此頁,請聯絡系統管理員.');
            //redirect to another page
            return redirect()->route('home'); 
        }

        //        $orders=DB::table('orders')->orderBy('created_at', 'desc')->get(); 

        $orders_query=" SELECT "; 
        $orders_query.="a.*,b.order_level,b.quantity,b.price, ";
        $orders_query.="b.box,b.id as item_id   ";
        $orders_query.="FROM orders a "; 
        $orders_query.="LEFT JOIN items b on a.order_id=b.order_id   ";
        $orders_query.="ORDER BY b.id DESC ";
        $orders = DB::select($orders_query);

        $orderArray[0]="";
        $myIndex=0;

        foreach($orders as $order){
            $itemString="";
            $itemIndex=0;

            $makeOrderArray=array("id"=>$order->id,
                                  "item_id"=>$order->item_id,
                                  "order_user_id"=>$order->order_user_id,
                                  "order_user_name"=>$order->order_user_name,
                                  "telphone"=>$order->telphone, 
                                  "addr"=>$order->addr,
                                  "paid"=>$order->paid,
                                  "shipping"=>$order->shipping,
                                  "created_at"=>$order->created_at,
                                  "order_date"=>date("Y-m-d", strtotime($order->created_at)),
                                  "updated_at"=>$order->updated_at,
                                  "message_board"=>$order->message_board,
                                  "order_id"=>$order->order_id,
                                  "level"=>$order->order_level,
                                  "quantity"=>$order->quantity,
                                  "price"=>$order->price, 
                                  "box"=>$order->box );
            $orderArray[$myIndex]=$makeOrderArray;
            $myIndex+=1;
        }

        return $orderArray;

    }


}
