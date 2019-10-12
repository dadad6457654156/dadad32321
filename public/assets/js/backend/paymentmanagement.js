define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'paymentmanagement/index' + location.search,
                    add_url: 'paymentmanagement/add',
                    edit_url: 'paymentmanagement/edit',
                    del_url: 'paymentmanagement/del',
                    multi_url: 'paymentmanagement/multi',
                    table: 'paymentmanagement',
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
                            {field: 'dingdanhao', title: __('Dingdanhao')},
                        {field: 'Redeemtheaccount', title: __('Redeemtheaccount')},
                        {field: 'username', title: __('Username')},
                        {field: 'Amount', title: __('Amount'), operate:'BETWEEN'},
                        {field: 'Handlingee', title: __('Handlingee'), operate:'BETWEEN'},
                        {field: 'Redeemtheaccountqmoney', title: __('Redeemtheaccountqmoney'), operate:'BETWEEN'},
                        {field: 'Redeemtheaccounthmoney', title: __('Redeemtheaccounthmoney'), operate:'BETWEEN'},
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