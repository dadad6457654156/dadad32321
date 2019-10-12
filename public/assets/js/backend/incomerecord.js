define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'incomerecord/index' + location.search,
                    add_url: 'incomerecord/add',
                    edit_url: 'incomerecord/edit',
                    del_url: 'incomerecord/del',
                    multi_url: 'incomerecord/multi',
                    table: 'incomerecord',
                }
            });

            var table = $("#table");
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
                        {field: 'Redeemintotheaccount', title: __('Redeemintotheaccount')},
                        {field: 'Amount', title: __('Amount'), operate:'BETWEEN'},
                        {field: 'Redeemintotheaccountqmoney', title: __('Redeemintotheaccountqmoney'), operate:'BETWEEN'},
                        {field: 'Redeemintotheaccounthmoney', title: __('Redeemintotheaccounthmoney'), operate:'BETWEEN'},
                        {field: 'huiyuanzhanghao', title: __('Huiyuanzhanghao'), operate:'BETWEEN'},
                        {field: 'pingtaidingdan', title: __('Pingtaidingdan'), operate:'BETWEEN'},
                        {field: 'source', title: __('Source'), searchList: {"0":__('Source 0'),"1":__('Source 1')}, formatter: Table.api.formatter.normal},
                        {field: 'beizhu', title: __('Beizhu')},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
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