define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'zhanghujiaodui/index' + location.search,
                    add_url: 'zhanghujiaodui/add',
                    edit_url: 'zhanghujiaodui/edit',
                    del_url: 'zhanghujiaodui/del',
                    multi_url: 'zhanghujiaodui/multi',
                    table: 'zhanghujiaodui',
                }
            });

            var table = $("#table");
                
                        //当表格数据加载完成时
            table.on('load-success.bs.table', function (e, data) {
                //这里可以获取从服务端获取的JSON数据
             
              
              if(data.extend.num > 1){
              Toastr.error(__('金额类查询条件只能查询一项！'));	
              }
              if(data.extend.num == 1  &&  data.extend.cxtj == 'kehulaikuan' ){
              	
              	if(data.extend.kehulaikuan  == data.extend.ptmoney){
              	Toastr.success(__('平台充值金额与入账金额一致！'));	
              	}else{
              	if(data.extend.kehulaikuan >  data.extend.ptmone){
              	 Toastr.error(__( '多入账' + (data.extend.kehulaikuan - data.extend.ptmoney )+ '元'));
              	}else{  
              	Toastr.error(__( '少入账' + ( data.extend.ptmoney -  data.extend.kehulaikuan)+ '元'));	
              	 
              		
              	}
              		
              			
              		
              	}
              	
              }
              
              
              
              
                //这里我们手动设置底部的值
                $("#sjdqye").text(data.extend.sjdqye);
                $("#chichutuihuikuan").text(data.extend.zhichutuihui);
                $("#qitashourukuan").text(data.extend.qitashouru);
                $("#kehucunkuan").text(data.extend.kehulaikuan);  
                $("#huanhunzhuanruzijin").text(data.extend.huanhuizhuanru);
                $("#huanhuizhuanchuzijin").text(data.extend.huanhunzhuanchu);
                $("#chunkuanzijin").text(data.extend.chukuan); 
                $("#zhichuzijin").text(data.extend.zhichu);
                $("#zhuanruzijin").text(data.extend.zhuanru);
                $("#zhuanchuzijin").text(data.extend.zhuanchu);
                $("#shouxufeizijin").text(data.extend.shouxufei);
                $("#shishiyuezijin").text(data.extend.shishiyue);
                $("#baobiaoyuezijin").text(data.extend.zhglssye);
               
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
                        {field: 'Initialbalance', title: __('Initialbalance'), operate:'BETWEEN'},
                        {field: 'soushoshijianduanqianyue', title: __('Soushoshijianduanqianyue'), operate:'BETWEEN'},
                        {field: 'zhichutuihui', title: __('Zhichutuihui'), operate:'BETWEEN'},
                        {field: 'qitashouru', title: __('Qitashouru'), operate:'BETWEEN'},
                        {field: 'kehulaikuan', title: __('Kehulaikuan'), operate:'BETWEEN'},
                        {field: 'huanhuizhuanru', title: __('Huanhuizhuanru'), operate:'BETWEEN'},
                        {field: 'huanhuizhuanchu', title: __('Huanhuizhuanchu'), operate:'BETWEEN'},
                        {field: 'zhuanru', title: __('Zhuanru'), operate:'BETWEEN'},
                        {field: 'zhuanchu', title: __('Zhuanchu'), operate:'BETWEEN'},
                        {field: 'Handlingee', title: __('Handlingee'), operate:'BETWEEN'},
                        {field: 'chukuan', title: __('Chukuan'), operate:'BETWEEN'},
                        {field: 'zhichu', title: __('Zhichu'), operate:'BETWEEN'},
                        {field: 'shishijueyu', title: __('Shishijueyu'), operate:'BETWEEN'},
                         {field: 'zhglssye', title: __('zhglssye'), operate:'BETWEEN'},
                        
                        {field: 'source', title: __('Source'), searchList: {"0":__('Source 0'),"1":__('Source 1')}, formatter: Table.api.formatter.normal},
                        {field: 'status', title: __('Status'), searchList: {"0":__('Status 0'),"1":__('Status 1'),"2":__('Status 2'),"3":__('Status 3'),"4":__('Status 4'),"5":__('Status 5')}, formatter: Table.api.formatter.status},
                         {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                         
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