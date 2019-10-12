<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:75:"G:\WWW\xincaiwu\public/../application/admin\view\expenditurerecord\add.html";i:1569102908;s:58:"G:\WWW\xincaiwu\application\admin\view\layout\default.html";i:1562338656;s:55:"G:\WWW\xincaiwu\application\admin\view\common\meta.html";i:1562338656;s:57:"G:\WWW\xincaiwu\application\admin\view\common\script.html";i:1562338656;}*/ ?>
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
<select  id = "zhuanru" class="province form-control" name="row[Redeemtheaccount]" data-url="/admin/category/banklist"></select>
 
 
</div>

      <label class="control-label col-xs-12 col-sm-2">模糊搜索:</label>
        <div class="col-xs-12 col-sm-3">
            <input id="c-zhuanrumohu" class="form-control"  oninput="console.log('input');"  type="text">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccouid'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccouid" data-rule="required" class="form-control" name="row[Redeemtheaccouid]"  value="0">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Amount'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Amount" data-rule="required" class="form-control" name="row[Amount]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Handlingee'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Handlingee" class="form-control" name="row[Handlingee]" type="number" value="0">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccountqmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccountqmoney" class="form-control" name="row[Redeemtheaccountqmoney]" type="number"  value="0">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccounthmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-Redeemtheaccounthmoney" class="form-control" name="row[Redeemtheaccounthmoney]" type="number"  value="0">
        </div>
    </div>
    
           <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bumen'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
                        
            <select  id="c-bumen" data-rule="required" class="form-control selectpicker" name="row[bumen]">
                <?php if(is_array($bumenList) || $bumenList instanceof \think\Collection || $bumenList instanceof \think\Paginator): if( count($bumenList)==0 ) : echo "" ;else: foreach($bumenList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    
    
    
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-5" data-toggle="cxselect" data-selects="province,city,area">
<select class="province form-control" name="row[type]" data-url="/admin/category/zhichuapi"></select>
 
 
</div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Typeid'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-typeid" class="form-control" name="row[typeid]" type="number">
        </div>
    </div>
        <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Createtime'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-beizhu" class="form-control" name="row[createtime]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Beizhu'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <input id="c-beizhu" class="form-control" name="row[beizhu]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Pingzhengimages'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
            <div class="input-group">
                <input id="c-pingzhengimages" class="form-control" size="50" name="row[pingzhengimages]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-pingzhengimages" class="btn btn-danger plupload" data-input-id="c-pingzhengimages" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-pingzhengimages"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-pingzhengimages" class="btn btn-primary fachoose" data-input-id="c-pingzhengimages" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-pingzhengimages"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-pingzhengimages"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Source'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
                        
            <select  id="c-source" data-rule="required" class="form-control selectpicker" name="row[source]">
                <?php if(is_array($sourceList) || $sourceList instanceof \think\Collection || $sourceList instanceof \think\Paginator): if( count($sourceList)==0 ) : echo "" ;else: foreach($sourceList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
  <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Operator'); ?>:</label>
        <div class="col-xs-12 col-sm-5">
              <input id="c-operator" data-rule="required" class="form-control" name="row[operator]" type="text" value="<?php echo $admin['username']; ?>">
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