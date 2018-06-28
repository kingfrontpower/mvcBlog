@extends('main')

@section('title',' | 管理員的訂單')

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
<div class="container-fluid"> 
    <div class="row">
        <div class="col-md-12 my-background-color" >       
            <table class='table table-striped'>
                <tr>
                    <td width='70%' class="dxgrid-header-font"><br/>&nbsp;訂單列表<br/></td>
                    <td width='30%' class='text-right'>

                    </td>
                </tr>
                <tr>
                    <td colspan='2' style="text-align:center;max-width:100px; margin: 0 auto"><div id='gridContainer' ></div></td>
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
    var url_load = "{{ url("/")}}/totalOrderAdminService";
    var fileNameAndDate="大梨訂單"+"{{date("YmdHis")}}";
    $(function(){
        $("#gridContainer").dxDataGrid({     
            dataSource: DevExpress.data.AspNet.createStore({
                key: "item_id",
                loadUrl: url_load ,
                //            insertUrl: url + "/InsertOrder",
                //            updateUrl: url + "/UpdateOrder",
                //            deleteUrl: url + "/DeleteOrder",
                //            onBeforeSend: function(method, ajaxOptions) {
                //                ajaxOptions.xhrFields = { withCredentials: true };
                //            }
            }),
            paging: {
                pageSize: 50
            },
            pager: {
                showPageSizeSelector: true,
                showNavigationButtons: true,
                allowedPageSizes: [50, 100, 200],
                showInfo: true,
                infoText:'第 {0} 頁 , 共 {1} 頁 （共 {2} 筆）',
                visible:true,
            },
            export: {
                enabled: true,
                //            fileName: "frDataSource",
                fileName: fileNameAndDate,
                allowExportSelectedData: true,           
                texts:{
                    exportAll:"匯出全部資料",
                    exportSelectedRows:"選取部分資料",
                    exportTo:"匯出EXCEL",
                },
            },
            selection: {
                mode: "multiple"
            },columnChooser: {
                title: "欄位選擇器",
                enabled: true,
                mode: "dragAndDrop"  //"select"//
            },

            columns: [{
                dataField: "id",
                caption: "序號",  
                visible: false,

            },{
                dataField: "item_id",
                caption: "訂單編號",
                width:80,
                //                visible: false,

            }, { 
                dataField: "created_at",
                caption: "訂單日期時間",
                width: 120,
                visible: false,
            }, { 
                dataField: "order_date",
                caption: "訂單日期",
                width: 120,
            },  { 
                dataField: "order_user_id",
                caption: "訂購會員編號",
                //                visible: false,
                width: 20,
            }, { 
                dataField: "order_user_name",
                caption: "收件人姓名",
                width: 70,
            }, { 
                dataField: "telphone",
                caption: "聯絡電話",
                width: 100,
            }, { 
                dataField: "addr",
                caption: "收件地址",
                width: 250,
            },   { 
                dataField: "message_board",
                caption: "留言板",
                width: 100,
            }, {
                dataField: "level",
                caption: "商品內容", 
                width: 100,

            },{
                dataField: "quantity",
                caption: "數量", 
                width: 80,

            },{
                dataField: "price",
                caption: "價格小計", 
                width: 80,

            },{
                dataField: "box",
                caption: "禮盒", 
                width: 70,

            }, { 
                dataField: "paid",
                caption: "賣方確認收到款項",
                visible:false,
            },  { 
                dataField: "updated_at",
                caption: "資料更新日期",
                visible:false,
            },

                     ],
            summary: {
                totalItems: [{
                    column: "quantity",
                    summaryType: "sum",

                },{
                    column: "price",
                    summaryType: "sum",
                    valueFormat: "currency"
                }]
            },

            headerFilter: {
                visible: true
            },
            showBorders: true,
            AlternationEnabled:true,
            wordWrapEnabled: true,
            wordWrapEnabled: true,
            showColumnLines:true,
            showRowLines: true,
            hoverStateEnabled: true,
            //欄位寬度調整
            //            allowColumnResizing: true,

        });
    });
</script>


@endsection