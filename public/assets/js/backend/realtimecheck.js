define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'realtimecheck/index' + location.search,
                    add_url: 'realtimecheck/add',
                    edit_url: 'realtimecheck/edit',
                    del_url: 'realtimecheck/del',
                    multi_url: 'realtimecheck/multi',
                    table: 'realtimecheck',
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
                        {field: 'name', title: __('Name')},
                        {field: 'shangrijieyu', title: __('Shangrijieyu'), operate:'BETWEEN'},
                        {field: 'kehulaikuan', title: __('Kehulaikuan'), operate:'BETWEEN'},
                        {field: 'zhichutuihui', title: __('Zhichutuihui'), operate:'BETWEEN'},
                        {field: 'qitashouru', title: __('Qitashouru'), operate:'BETWEEN'},
                        {field: 'meijinduiru', title: __('Meijinduiru'), operate:'BETWEEN'},
                        {field: 'meijinduichu', title: __('Meijinduichu'), operate:'BETWEEN'},
                        {field: 'kehuchukuan', title: __('Kehuchukuan'), operate:'BETWEEN'},
                        {field: 'zhichu', title: __('Zhichu'), operate:'BETWEEN'},
                        {field: 'shouxufei', title: __('Shouxufei'), operate:'BETWEEN'},
                        {field: 'jingyingkui', title: __('Jingyingkui'), operate:'BETWEEN'},
                        {field: 'jinrijieyu', title: __('Jinrijieyu'), operate:'BETWEEN'},
                        {field: 'iszhengque', title: __('Iszhengque'), searchList: {"0":__('Iszhengque 0'),"1":__('Iszhengque 1')}, formatter: Table.api.formatter.normal},
                        {field: 'beiyongjinshangrijieyu', title: __('Beiyongjinshangrijieyu'), operate:'BETWEEN'},
                        {field: 'beiyongjinzhuanru', title: __('Beiyongjinzhuanru'), operate:'BETWEEN'},
                        {field: 'beiyonghjinzhuanchu', title: __('Beiyonghjinzhuanchu'), operate:'BETWEEN'},
                        {field: 'beiyongjinjieyu', title: __('Beiyongjinjieyu'), operate:'BETWEEN'},
                        {field: 'beiyongjinhedui', title: __('Beiyongjinhedui'), searchList: {"0":__('Beiyongjinhedui 0'),"1":__('Beiyongjinhedui 1')}, formatter: Table.api.formatter.normal},
                        {field: 'linshidongjie', title: __('Linshidongjie'), operate:'BETWEEN'},
                        {field: 'sanfangweijie', title: __('Sanfangweijie'), operate:'BETWEEN'},
                        {field: 'houtailiudongzijin', title: __('Houtailiudongzijin'), operate:'BETWEEN'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4'),"5":__('Status 5')}, formatter: Table.api.formatter.status},
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