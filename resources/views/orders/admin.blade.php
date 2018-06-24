@extends('main')

@section('title',' | 管理員的訂單')

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
<br>



<script>
    var url = "{{ url("/")}}/service_orders";
    var fileNameAndDate="訂單基本資料"+"{{date("YmdHis")}}";
    $(function(){
        $("#gridContainer").dxDataGrid({     
            dataSource: DevExpress.data.AspNet.createStore({
                key: "id",
                loadUrl: url ,
                //            insertUrl: url + "/InsertOrder",
                //            updateUrl: url + "/UpdateOrder",
                //            deleteUrl: url + "/DeleteOrder",
                //            onBeforeSend: function(method, ajaxOptions) {
                //                ajaxOptions.xhrFields = { withCredentials: true };
                //            }
            }),
            paging: {
                pageSize: 5
            },
            pager: {
                showPageSizeSelector: true,
                showNavigationButtons: true,
                allowedPageSizes: [5, 10, 20],
                showInfo: true,
                infoText:'第 {0} 頁 , 共 {1} 頁 （共 {2} 筆）',
                visible:true,
            },
            //            export: {
            //                enabled: true,
            //                //            fileName: "frDataSource",
            //                fileName: fileNameAndDate,
            //                allowExportSelectedData: true,           
            //                texts:{
            //                    exportAll:"匯出全部資料",
            //                    //                    exportSelectedRows:"選取部分資料",
            //                    exportTo:"匯出EXCEL",
            //                },
            //            },

            columns: [{
                dataField: "id",
                caption: "訂單序號",  
                visible: false,

            },  { 
                dataField: "created_at",
                caption: "訂單日期",
            },      { 
                dataField: "order_user_id",
                caption: "訂購會員",
                visible: false,
                //                      columnHidingEnabled: false,
            }, { 
                dataField: "order_user_name",
                caption: "收件人姓名",
            }, { 
                dataField: "telphone",
                caption: "聯絡電話",
            }, { 
                dataField: "addr",
                caption: "收件地址",
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

            height: 600,
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
                        //            insertUrl: url + "/InsertOrder",
                        //            updateUrl: url + "/UpdateOrder",
                        //            deleteUrl: url + "/DeleteOrder",
                        //            onBeforeSend: function(method, ajaxOptions) {
                        //                ajaxOptions.xhrFields = { withCredentials: true };
                        //            }
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
                        //        filterRow: {
                        //            visible: true
                        //        },
                        //                    headerFilter: {
                        //                        visible: true
                        //                    },

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