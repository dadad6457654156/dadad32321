<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:81:"/www/wwwroot/baidu.com/public/../application/admin/view/exchangeshuanhui/add.html";i:1569103331;s:65:"/www/wwwroot/baidu.com/application/admin/view/layout/default.html";i:1562338656;s:62:"/www/wwwroot/baidu.com/application/admin/view/common/meta.html";i:1562338656;s:64:"/www/wwwroot/baidu.com/application/admin/view/common/script.html";i:1562338656;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccount'); ?>:</label>
         
		
		   		    <div class="col-xs-12 col-sm-5" data-toggle="cxselect" data-selects="province,city,area">
<select   id = "zhuanru" class="province form-control" name="row[Redeemtheaccount]" data-url="/admin/category/banklist"></select>
 
 
</div>
        <label class="control-label col-xs-12 col-sm-2">模糊搜索:</label>
        <div class="col-xs-12 col-sm-3">
            <input id="c-zhuanrumohu" class="form-control"  oninput="console.log('input');"  type="text">
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccouid'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccouid" data-rule="required" class="form-control" name="row[Redeemtheaccouid]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccount'); ?>:</label>
        
			    <div class="col-xs-12 col-sm-5" data-toggle="cxselect" data-selects="province,city,area">
<select  id="zhuanchu"  class="province form-control" name="row[Redeemintotheaccount]" data-url="/admin/category/banklist"></select>
 
 
</div>
		  <label class="control-label col-xs-12 col-sm-2">模糊搜索:</label>
        <div class="col-xs-12 col-sm-3">
            <input id="c-zhuanchumohu" class="form-control" name="row[beizhu]" type="text">
        </div>
    </div>
    <div class="form-group"  style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccountid'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemintotheaccountid" data-rule="required" class="form-control" name="row[Redeemintotheaccountid]" type="number" value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cashoutamount'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-CashoutAmount" data-rule="required" class="form-control" step="0.01" name="row[CashoutAmount]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redemptioamount'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redemptioamount" data-rule="required" class="form-control" step="0.01" name="row[Redemptioamount]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Exchangerate'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-exchangerate" data-rule="required" class="form-control" step="0.01" name="row[exchangerate]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Handlingee'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Handlingee" data-rule="required" class="form-control" step="0.01" name="row[Handlingee]" type="number">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccountqmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccountqmoney" data-rule="required" class="form-control" step="0.01" name="row[Redeemtheaccountqmoney]" type="number" value="0">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccounthmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccounthmoney" data-rule="required" class="form-control" step="0.01" name="row[Redeemtheaccounthmoney]" type="number" value="0">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccountqmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemintotheaccountqmoney" data-rule="required" class="form-control" step="0.01" name="row[Redeemintotheaccountqmoney]" type="number" value="0">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccounthmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemintotheaccounthmoney" data-rule="required" class="form-control" step="0.01" name="row[Redeemintotheaccounthmoney]" type="number" value="0">
        </div>
    </div>
  <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Operator'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
              <input id="c-operator" data-rule="required" class="form-control" name="row[operator]" type="text" value="<?php echo $admin['username']; ?>">
        </div>
    </div>
	
		     <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Createtime'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-beizhu" class="form-control" name="row[createtime]" type="text">
        </div>
    </div>
	
	
	
	  <div class="form-group" >
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Beizhu'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
              <input id="c-operator" data-rule="required" class="form-control" name="row[beizhu]" type="text" >
        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-5">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>
<script type="text/javascript">
document.getElementById('c-zhuanrumohu').oninput=function(){
if(document.getElementById('c-zhuanrumohu').value.length > 0){
	var name =  document.getElementById('c-zhuanrumohu').value;
 $.get("/admin/category/banklist?name="+name,function(data,status){
    
  jQuery("#zhuanru").empty();  
  
  $("#zhuanru").append("<option value='查询成功"+data.data.length+"个符合条件'>查询成功"+data.data.length+"个符合条件</option>");   
for(var i = 0, len = data.data.length; i < len; i++){
 $("#zhuanru").append("<option value='"+data.data[i].name+"'>"+data.data[i].name+"</option>");
}
});	
}else{
 $.get("/admin/category/banklist",function(data,status){
    
  jQuery("#zhuanru").empty();  
  $("#zhuanru").append("<option value='请选择'>请选择</option>");   
for(var i = 0, len = data.data.length; i < len; i++){
 $("#zhuanru").append("<option value='"+data.data[i].name+"'>"+data.data[i].name+"</option>");
}
});	
}
}

document.getElementById('c-zhuanchumohu').oninput=function(){
if(document.getElementById('c-zhuanchumohu').value.length > 0){
	var name =  document.getElementById('c-zhuanchumohu').value;
 $.get("/admin/category/banklist?name="+name,function(data,status){
    
  jQuery("#zhuanchu").empty();  
  
  $("#zhuanchu").append("<option value='查询成功"+data.data.length+"个符合条件'>查询成功"+data.data.length+"个符合条件</option>");   
for(var i = 0, len = data.data.length; i < len; i++){
 $("#zhuanchu").append("<option value='"+data.data[i].name+"'>"+data.data[i].name+"</option>");
}
});	
}else{
 $.get("/admin/category/banklist",function(data,status){
    
  jQuery("#zhuanchu").empty();  
  $("#zhuanchu").append("<option value='请选择'>请选择</option>");   
for(var i = 0, len = data.data.length; i < len; i++){
 $("#zhuanchu").append("<option value='"+data.data[i].name+"'>"+data.data[i].name+"</option>");
}
});	
}
}












</script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>