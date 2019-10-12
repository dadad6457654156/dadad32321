define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'realtimecheckmeitian/index' + location.search,
                    add_url: 'realtimecheckmeitian/add',
                    edit_url: 'realtimecheckmeitian/edit',
                    del_url: 'realtimecheckmeitian/del',
                    multi_url: 'realtimecheckmeitian/multi',
                    table: 'realtimecheckmeitian',
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
                        
                        {field: 'Shijian', title: __('Shijian')},  //时间段
                       
                         {field: 'bizhong', title: __('bizhong'), searchList: {"0":__('bizhong 0'),"1":__('bizhong 1')}, formatter: Table.api.formatter.normal},
                        {field: 'chaxunqianjieyu', title: __('chaxunqianjieyu') }, //查询前结余
                        
                        {field: 'shangrijieyu', title: __('Shangrijieyu'), operate:'BETWEEN'},//上日结余
                        {field: 'jinrijieyu', title: __('jinrijieyu'), operate:'BETWEEN'},//今日结余
                        {field: 'kehulaikuan', title: __('kehulaikuan'), operate:'BETWEEN'},
                        {field: 'zhichutuihui', title: __('Zhichutuihui'), operate:'BETWEEN'},
                        {field: 'qitashouru', title: __('Qitashouru'), operate:'BETWEEN'},
                        {field: 'meijinduiru', title: __('Meijinduiru'), operate:'BETWEEN'},
                        {field: 'meijinduichu', title: __('Meijinduichu'), operate:'BETWEEN'},
                        {field: 'kehuchukuan', title: __('Kehuchukuan'), operate:'BETWEEN'},
                        {field: 'zhichu', title: __('Zhichu'), operate:'BETWEEN'},
                        {field: 'shouxufei', title: __('Shouxufei'), operate:'BETWEEN'},
                        {field: 'chongtiyingkui', title: __('chongtiyingkui'), operate:'BETWEEN'},
                        {field: 'jinrijieyu', title: __('Jinrijieyu'), operate:'BETWEEN'},
                        {field: 'linshidongjiekuan', title: __('linshidongjiekuan'), operate:'BETWEEN'},
                        {field: 'zhengchangzichan', title: __('zhengchangzichan'), operate:'BETWEEN'},
                        {field: 'beiyongjinjieyu', title: __('beiyongjinjieyu'), operate:'BETWEEN'},
                        {field: 'houtaikeyong', title: __('houtaikeyong'), operate:'BETWEEN'},
                   
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        
                     
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