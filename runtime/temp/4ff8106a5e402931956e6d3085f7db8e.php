<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:68:"G:\WWW\xincaiwu\public/../application/admin\view\sjtjbiao\index.html";i:1569443353;s:58:"G:\WWW\xincaiwu\application\admin\view\layout\default.html";i:1562338656;s:55:"G:\WWW\xincaiwu\application\admin\view\common\meta.html";i:1562338656;s:57:"G:\WWW\xincaiwu\application\admin\view\common\script.html";i:1562338656;}*/ ?>
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
                                <form class="form-horizontal form-commonsearch nice-validator n-default n-bootstrap" novalidate="" method="post" action="">
	<fieldset>
		<div class="row">
 
			<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label for="status" class="control-label col-xs-4">查询类型</label>
				<div class="col-xs-8"><input type="hidden" class="form-control operate" name="status-operate" data-name="status"
					 value="=" readonly=""><select id = "status" class="form-control" name="status">
						<option value="">选择</option>
						<option value="0">人民币支出类型报表</option>
						<option value="1">美金支出类型报表</option>
						<option value="2">人民币支出部门报表</option>
						<option value="3">美金支出部门报表</option>
						<option value="4">每日支出美金报表</option>
						<option value="5">每日支出人民币报表</option>
						<option value="6">每日收款报表</option>
						<option value="7">每日出款报表</option>
						<option value="8">每日存取款盈亏报表</option>
 					
					</select></div>
			</div> 
 
			<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label for="createtime" class="control-label col-xs-4">开始时间</label>
				<div class="col-xs-8"><input type="hidden" class="form-control operate" name="createtime-operate" data-name="createtime"
						 value="RANGE" readonly="">
		 
						  <input   id = "kaishishijian" type="datetime" class="form-control datetimepicker" name="kaishishijian" value="" placeholder="开始时间" id="s" data-date-format="YYYY-MM-DD" />
 
						
						 
						 </div>
			</div>
			<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3"><label for="updatetime" class="control-label col-xs-4">结束时间</label>
				<div class="col-xs-8"><input   type="hidden" class="form-control operate" name="updatetime-operate" data-name="updatetime"
					 value="RANGE" readonly="">
				 	 <input  id = "jieshushijian" type="datetime" class="form-control datetimepicker" name="jieshushijian" value="" placeholder="结束时间" id="s" data-date-format="YYYY-MM-DD" /></div>
			</div>
	 
			<div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
				<div class="col-sm-8 col-xs-offset-4"><button  id = "text1" type="button" class="btn btn-success" formnovalidate="">提交</button>
					<button type="reset" class="btn btn-default">重置</button> </div>
			</div>
		</div>
	</fieldset>
</form>
 

 
















                  <div id="echart" style="width: 100%;height:600px;">报表</div>
  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>