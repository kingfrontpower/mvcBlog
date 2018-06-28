@extends('main')

@section('title',' | 顯示訂單')

@section('myStyleSheet')
<style>
    .my-background-color{
        background-color: #eee; 
    }
</style>
@endsection

@section('cdnDevextreme')

@include('partials._cdnDevextreme')

@endsection

@section('content')
<div class="container"> 
    <div class="row">
        <div class="col-md-12 my-background-color" >       
            <table class='table table-striped'>
                <tr>
                    <td width='70%' class="dxgrid-header-font"><br/>&nbsp;訂單列表<br/></td>
                    <td width='30%' class='text-right'>

                    </td>
                </tr>
                <tr>
                    <td colspan='2'style="text-align:center;max-width:100px; margin: 0 auto"><div id='gridContainer' ></div></td>
                </tr>


            </table> 
            <div class="text-center">

            </div>      
        </div>    
    </div>
</div>
<br>



<script>
    var url = "{{ url("/")}}/service_orders";
    var fileNameAndDate="訂單基本資料"+"{{date("YmdHis")}}";
    $(function(){
        $("#gridContainer").dxDataGrid({     
            dataSource: DevExpress.data.AspNet.createStore({
                key: "id",
                loadUrl: url ,                
            }),
            paging: {
                pageSize: 20
            },
            pager: {
                showPageSizeSelector: true,
                showNavigationButtons: true,
                allowedPageSizes: [ 10, 20,50,100,500],
                showInfo: true,
                infoText:'第 {0} 頁 , 共 {1} 頁 （共 {2} 筆）',
                visible:true,
            },columns: [{
                dataField: "id",
                caption: "訂單序號",  
                visible: false,

            },  { 
                dataField: "order_date",
                caption: "訂單日期",
                type: "date",

            },  { 
                dataField: "order_user_id",
                caption: "訂購會員",
                visible: false,
            }, { 
                dataField: "order_user_name",
                caption: "收件人姓名",
            }, { 
                dataField: "telphone",
                caption: "聯絡電話",
            }, { 
                dataField: "addr",
                caption: "收件地址",
            },{ 
                dataField: "message_board",
                caption: "留言板",
            }, { 
                dataField: "paid",
                caption: "賣方確認收到款項",
                visible:false,
            },  { 
                dataField: "updated_at",
                caption: "資料更新日期",
                visible:false,
            }, { 
                dataField: "order_id",
                caption: "訂單編號",
                visible:false,
            }, 
                       ],

            headerFilter: {
                visible: true
            },

            //            height: 600,
            showBorders: true,
            //第二層選單
            masterDetail: {
                enabled: true,

                template: function(container, options) { 
                    var currentData = options.data;
                    var load_url = "{{url('/')}}/service_items";
                    var service_items=DevExpress.data.AspNet.createStore({
                        key: "id",
                        loadUrl: load_url ,

                    });

                    $("<div>")
                        .addClass("master-detail-caption")
                        .text("訂單內容")
                        .appendTo(container);

                    $("<div>").dxDataGrid({     
                        dataSource: service_items,
                        filterValue:["order_id","=",currentData.order_id],
                        columns: [{
                            dataField: "id",
                            caption: "id", 
                            visible: false,

                        }, {
                            dataField: "created_at",
                            caption: "訂單日期",
                            visible: false, 

                        }, {
                            dataField: "order_level",
                            caption: "商品內容",          

                        }, {
                            dataField: "quantity",
                            caption: "數量",          

                        }, {
                            dataField: "price",
                            caption: "價格",          

                        }, {
                            dataField: "box",
                            caption: "是否要禮盒",          

                        },   {
                            dataField: "updated_at",
                            caption: "更新日期", 
                            visible: false,

                        },  {
                            dataField: "order_id",
                            caption: "訂單序號",   
                            visible: false,

                        },        ],
                        summary: {
                            totalItems: [{
                                column: "quantity",
                                summaryType: "sum",

                            },{
                                column: "price",
                                summaryType: "sum",
                                valueFormat: "currency"
                            },


                                        ]
                        }

                    }).appendTo(container);

                } // ---------------------------end template
            },// ---------------------end masterDetail
            //儲存格換行
            wordWrapEnabled: true,
            showColumnLines:true,
            showRowLines: true,
            hoverStateEnabled: true,
            //欄位寬度調整
            allowColumnResizing: true,

        });
    });
</script>


@endsection