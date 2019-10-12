define(['jquery', 'bootstrap', 'backend', 'addtabs', 'table', 'echarts', 'echarts-theme', 'template'], function ($, undefined, Backend, Datatable, Table, Echarts, undefined, Template) {
	
	
	var form = $("form.form-horizontal.form-commonsearch.nice-validator.n-default.n-bootstrap");
	console.log(form);
if ($(".datetimepicker", form).size() > 0) {
     require(['bootstrap-datetimepicker'], function () {
     	var options = {
                            format: 'YYYY-MM-DD HH:mm:ss',   //
                            icons: {
                                time: 'fa fa-clock-o',
                                date: 'fa fa-calendar',
                                up: 'fa fa-chevron-up',
                                down: 'fa fa-chevron-down',
                                previous: 'fa fa-chevron-left',
                                next: 'fa fa-chevron-right',
                                today: 'fa fa-history',
                                clear: 'fa fa-trash',
                                close: 'fa fa-remove'
                            },
                            showTodayButton: true,
                            showClose: true
                        };
                        $('.datetimepicker', form).parent().css('position', 'relative');
                        $('.datetimepicker', form).datetimepicker(options);
	});
}	
	
	
	
	
	
	
	
  
 var Controller = {

    index: function () {
        // 基于准备好的dom，初始化echarts实例
        var myChart = Echarts.init(document.getElementById('echart'), 'walden');
        // 指定图表的配置项和数据   // 找的最基础的入门示例
          	  var typelist =new Array();
    	  var money=new Array();
    	  $.get("/admin/sjtjbiao/zhichu?ref=addtabs222", function(result){
    	  	typelist = result.typelist;
    	  	money =  result.money;
        var option = { 
            title: {
                text: '默认报表'
            },
            tooltip: {},
            legend: {
                data:['支出类别']
                
            },
            xAxis: {
            	axisLabel : {//坐标轴刻度标签的相关设置。
                interval:0,
                rotate:"20"
            },
                data:result.typelist
            },
                 
            
            yAxis: {},
            series: [{
                name: '支出金额',
                type: 'bar',
                data: result.money 
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
   
        
        
        
    	  });  
    $("#text1").on("click",function(){
    	
    	var kaishishijian = $("#kaishishijian").val();
    	var jieshushijian = $("#jieshushijian").val();
    	var status = $("#status").val();
    	var statustext = $("#status").find("option:selected").text();
    	if(!kaishishijian){
    		Toastr.error(__('开始时间不能为空！'));	
    	 return;	 
    	  
    	}
    	if(!jieshushijian){
    		Toastr.error(__('结束时间不能为空！'));	
    	  return;
    	 
    	}
    	if(!status){
    		Toastr.error(__('查询类型不能为空！'));	
      return;
     
    	}
    	console.log(kaishishijian);
    	
    	console.log(status);
    	
    	console.log(jieshushijian);
		    	  $.get("/admin/sjtjbiao/zhichu?ref=addtabs&Startingtime="+kaishishijian+"&EndTime="+jieshushijian+"&status="+status, function(result){
    	  	typelist = result.typelist;
    	  	money =  result.money;
        var option = { 
            title: {
                text: statustext
            },
            tooltip: {},
            legend: {
                data:['支出类别']
                
            },
            xAxis: {
            	axisLabel : {//坐标轴刻度标签的相关设置。
                interval:0,
                rotate:"20"
            },
                data:result.typelist
            },
                 
            
            yAxis: {},
            series: [{
                name: '支出金额',
                type: 'bar',
                data: result.money 
            }]
        };
        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
   
        
        
        
    	  }); 
	});    
        
        
        
        
    }
    };

    return Controller;
});

 