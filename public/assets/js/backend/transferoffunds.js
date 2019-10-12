define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'transferoffunds/index' + location.search,
                    add_url: 'transferoffunds/add',
                    edit_url: 'transferoffunds/edit',
                    del_url: 'transferoffunds/del',
                    multi_url: 'transferoffunds/multi',
                    table: 'transferoffunds',
                }
            });

            var table = $("#table");
          // table.on('post-common-search.bs.table', function (event, table) {
               // var form = $("form", table.$commonsearch);
              //  $("input[name='Redeemintotheaccount']", form).addClass("selectpage").data("source", "auth/adminlog/selectpage").data("primaryKey", "title").data("field", "title").data("orderBy", "id desc");
                //$("input[name='Redeemintotheaccount']", form).addClass("selectpage").data("source", "/admin/category/banklist").data("primaryKey", "name").data("field", "name").data("orderBy", "id desc");
               // Form.events.cxselect(form);
              //  Form.events.selectpage(form);
          //  });

            
            

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
                       // $("input[name='title']", form).addClass("selectpage").data("source", "auth/adminlog/selectpage").data("primaryKey", "title").data("field", "title").data("orderBy", "id desc");
                        
                       // {field: 'Redeemtheaccouid', title: __('Redeemtheaccouid')},
                        {field: 'Redeemintotheaccount', title: __('Redeemintotheaccount')},
                       // {field: 'Redeemintotheaccountid', title: __('Redeemintotheaccountid')},
                        {field: 'Amount', title: __('Amount'), operate:'BETWEEN'},
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