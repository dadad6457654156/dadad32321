define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'exchangeshuanhui/index' + location.search,
                    add_url: 'exchangeshuanhui/add',
                    edit_url: 'exchangeshuanhui/edit',
                    del_url: 'exchangeshuanhui/delete',
                    multi_url: 'exchangeshuanhui/multi',
                    table: 'exchangeshuanhui',
                }
            });

            var table = $("#table");

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
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2')}, formatter: Table.api.formatter.status},
                        {field: 'Redeemintotheaccount', title: __('Redeemintotheaccount')},
                        {field: 'CashoutAmount', title: __('Cashoutamount'), operate:'BETWEEN'},
                        {field: 'Redemptioamount', title: __('Redemptioamount'), operate:'BETWEEN'},
                        {field: 'exchangerate', title: __('Exchangerate'), operate:'BETWEEN'},
                        {field: 'Handlingee', title: __('Handlingee'), operate:'BETWEEN'},
                        {field: 'Redeemtheaccountqmoney', title: __('Redeemtheaccountqmoney'), operate:'BETWEEN'},
                        {field: 'Redeemtheaccounthmoney', title: __('Redeemtheaccounthmoney'), operate:'BETWEEN'},
                        {field: 'Redeemintotheaccountqmoney', title: __('Redeemintotheaccountqmoney'), operate:'BETWEEN'},
                        {field: 'Redeemintotheaccounthmoney', title: __('Redeemintotheaccounthmoney'), operate:'BETWEEN'},
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