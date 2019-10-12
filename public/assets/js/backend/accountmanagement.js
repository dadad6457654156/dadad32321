define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
            		showFooter:true,
                extend: {
                
                    index_url: 'accountmanagement/index' + location.search,
                    add_url: 'accountmanagement/add',
                    edit_url: 'accountmanagement/edit',
                    del_url: 'accountmanagement/del',
                    multi_url: 'accountmanagement/multi',
                    table: 'accountmanagement',
                }
            });

            var table = $("#table");
            
                        //当表格数据加载完成时
            table.on('load-success.bs.table', function (e, data) {
                //这里可以获取从服务端获取的JSON数据
                console.log(data);
                //这里我们手动设置底部的值
                $("#money").text(data.extend.money);
                $("#price").text(data.extend.price);
            });
            

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'name', title: __('Name')},
                        {field: 'type', title: __('Type')},
                        {field: 'Initialbalance', title: __('Initialbalance')},
                        {field: 'balance', title: __('Balance')},
                        {field: 'source', title: __('Source'), searchList: {"0":__('Source 0'),"1":__('Source 1')}, formatter: Table.api.formatter.normal},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"5":__('Status 5'), "1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4')},formatter: Table.api.formatter.status},
                        {field: 'beizhu', title: __('Beizhu')},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operator', title: __('Operator')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});

 


$(document).ready(function(){
$( "#gengxinyue" ).on( "click", function() {
 $.get("/admin/accountmanagement/getmoney", function(result){
   
  });	
console.log(1111);	
	
} ); 

	
	

})




