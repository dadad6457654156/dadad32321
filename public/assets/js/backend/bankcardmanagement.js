define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'bankcardmanagement/index' + location.search,
                    add_url: 'bankcardmanagement/add',
                    edit_url: 'bankcardmanagement/edit',
                    del_url: 'bankcardmanagement/del',
                    multi_url: 'bankcardmanagement/multi',
                    table: 'bankcardmanagement',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'ID',
                sortName: 'ID',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'ID', title: __('Id')},
                        {field: 'accountmanagementID', title: __('Accountmanagementid')},
                        {field: 'name', title: __('Name')},
                        {field: 'type', title: __('Type')},
                        {field: 'balance', title: __('Balance'), operate:'BETWEEN'},
                        {field: 'IDnumber', title: __('Idnumber')},
                        //{field: 'Homeaddress', title: __('Homeaddress')},
                        //{field: 'telephone', title: __('Telephone')},
                        {field: 'Phonenumberstatus', title: __('Phonenumberstatus'), searchList: {"0":__('Phonenumberstatus 0'),"1":__('Phonenumberstatus 1'),"2":__('Phonenumberstatus 2'),"3":__('Phonenumberstatus 3'),"4":__('Phonenumberstatus 4'),"5":__('Phonenumberstatus 5')}, formatter: Table.api.formatter.status},
                        //{field: 'Bankcardnumber', title: __('Bankcardnumber')},
                        //{field: 'subBankcardnumber', title: __('Subbankcardnumber')},
                        //{field: 'Loginaccount', title: __('Loginaccount')},
                        //{field: 'loginpassword', title: __('Loginpassword')},
                        //{field: 'Ushieldpassword', title: __('Ushieldpassword')},
                        //{field: 'Withdrawalspassword', title: __('Withdrawalspassword')},
                        //{field: 'IDcardfrontpicturez', title: __('Idcardfrontpicturez')},
                        //{field: 'IDcardreversepictures', title: __('Idcardreversepictures')},
                        //{field: 'bankcardfrontpicture', title: __('Bankcardfrontpicture')},
                        //{field: 'bankcardreversepicture', title: __('Bankcardreversepicture')},
                       {field: 'Cardstatus', title: __('Cardstatus')},
                        {field: 'Remarks', title: __('Remarks')},
                        {field: 'NumberofAlipays', title: __('Numberofalipays')},
                        {field: 'NumberofWeChat', title: __('Numberofwechat')},
                        {field: 'IsopenWeChat', title: __('Isopenwechat'), searchList: {"0":__('Isopenwechat 0'),"1":__('Isopenwechat 1'),"2":__('Isopenwechat 2')}, formatter: Table.api.formatter.normal},
                        {field: 'IsopenAlipay', title: __('Isopenalipay'), searchList: {"0":__('Isopenalipay 0'),"1":__('Isopenalipay 1'),"2":__('Isopenalipay 2')}, formatter: Table.api.formatter.normal},
                        {field: 'Dateofpurchase', title: __('Dateofpurchase'), operate:'RANGE', addclass:'datetimerange'},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'updatetime', title: __('Updatetime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'administrator', title: __('Administrator')},
                        {field: 'Shieldnumber', title: __('Shieldnumber')},
                        {field: 'yanzhengjizhi', title: __('Yanzhengjizhi'), searchList: {"0":__('Yanzhengjizhi 0'),"1":__('Yanzhengjizhi 1'),"2":__('Yanzhengjizhi 2'),"3":__('Yanzhengjizhi 3')}, formatter: Table.api.formatter.normal},
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