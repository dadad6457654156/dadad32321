<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:76:"G:\WWW\xincaiwu\public/../application/admin\view\bankcardmanagement\add.html";i:1570618957;s:58:"G:\WWW\xincaiwu\application\admin\view\layout\default.html";i:1562338656;s:55:"G:\WWW\xincaiwu\application\admin\view\common\meta.html";i:1562338656;s:57:"G:\WWW\xincaiwu\application\admin\view\common\script.html";i:1562338656;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Accountmanagementid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-accountmanagementID" data-rule="required" class="form-control" name="row[accountmanagementID]" type="number">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" class="form-control" name="row[name]" type="text">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-type" class="form-control" name="row[type]" type="text">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Balance'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-balance" class="form-control" step="0.01" name="row[balance]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDnumber" class="form-control " rows="5" name="row[IDnumber]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Homeaddress'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Homeaddress" class="form-control " rows="5" name="row[Homeaddress]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Telephone'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-telephone" class="form-control " rows="5" name="row[telephone]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Phonenumberstatus'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($phonenumberstatusList) || $phonenumberstatusList instanceof \think\Collection || $phonenumberstatusList instanceof \think\Paginator): if( count($phonenumberstatusList)==0 ) : echo "" ;else: foreach($phonenumberstatusList as $key=>$vo): ?>
            <label for="row[Phonenumberstatus]-<?php echo $key; ?>"><input id="row[Phonenumberstatus]-<?php echo $key; ?>" name="row[Phonenumberstatus]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Bankcardnumber" class="form-control " rows="5" name="row[Bankcardnumber]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Subbankcardnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-subBankcardnumber" class="form-control " rows="5" name="row[subBankcardnumber]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Loginaccount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Loginaccount" class="form-control " rows="5" name="row[Loginaccount]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Loginpassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-loginpassword" class="form-control " rows="5" name="row[loginpassword]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ushieldpassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Ushieldpassword" class="form-control " rows="5" name="row[Ushieldpassword]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Withdrawalspassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Withdrawalspassword" class="form-control " rows="5" name="row[Withdrawalspassword]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcardfrontpicturez'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDcardfrontpicturez" class="form-control " rows="5" name="row[IDcardfrontpicturez]" cols="50"></textarea>
			 <input type="file" id="img_upload"/> 注：选择身份证正面
        </div>
		

 
    
        <p id="img_area"></p>
    </div>
	
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcardreversepictures'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDcardreversepictures" class="form-control " rows="5" name="row[IDcardreversepictures]" cols="50"></textarea>
			 <input type="file" id="img_uploadshenfenzngfan"/> 注：选择身份证反面
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardfrontpicture'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-bankcardfrontpicture" class="form-control " rows="5" name="row[bankcardfrontpicture]" cols="50"></textarea>
				 <input type="file" id="img_uploadbanzheng"/> 注：选择银行卡正面
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardreversepicture'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-bankcardreversepicture" class="form-control " rows="5" name="row[bankcardreversepicture]" cols="50"></textarea>
			 <input type="file" id="img_uploadbanfan"/> 注：选择银行卡反面
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cardstatus'); ?>:</label>
   
                  <div class="col-xs-12 col-sm-8" data-toggle="cxselect" data-selects="province,city,area">
<select class="province form-control" name="row[type]" data-url="/admin/category/typeaa"></select>
 
 
 
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Remarks" class="form-control " rows="5" name="row[Remarks]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Numberofalipays'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-NumberofAlipays" class="form-control" name="row[NumberofAlipays]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Numberofwechat'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-NumberofWeChat" class="form-control" name="row[NumberofWeChat]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isopenwechat'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-IsopenWeChat" class="form-control selectpicker" name="row[IsopenWeChat]">
                <?php if(is_array($isopenwechatList) || $isopenwechatList instanceof \think\Collection || $isopenwechatList instanceof \think\Paginator): if( count($isopenwechatList)==0 ) : echo "" ;else: foreach($isopenwechatList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"2"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isopenalipay'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-IsopenAlipay" data-rule="required" class="form-control selectpicker" name="row[IsopenAlipay]">
                <?php if(is_array($isopenalipayList) || $isopenalipayList instanceof \think\Collection || $isopenalipayList instanceof \think\Paginator): if( count($isopenalipayList)==0 ) : echo "" ;else: foreach($isopenalipayList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"2"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Dateofpurchase'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Dateofpurchase" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[Dateofpurchase]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Administrator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-administrator" class="form-control" name="row[administrator]" type="text" value="<?php echo $admin['username']; ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Shieldnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Shieldnumber" class="form-control" name="row[Shieldnumber]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Yanzhengjizhi'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-yanzhengjizhi" class="form-control selectpicker" name="row[yanzhengjizhi]">
                <?php if(is_array($yanzhengjizhiList) || $yanzhengjizhiList instanceof \think\Collection || $yanzhengjizhiList instanceof \think\Paginator): if( count($yanzhengjizhiList)==0 ) : echo "" ;else: foreach($yanzhengjizhiList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"0"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
	
	
</form>
        <script type="text/javascript">
        window.onload = function(){ 
        // 抓取上传图片，转换代码结果，显示图片的dom
        var img_upload=document.getElementById("img_upload");
		var img_uploadshenfenzngfan=document.getElementById("img_uploadshenfenzngfan");
		var img_uploadbanzheng=document.getElementById("img_uploadbanzheng");
        var img_uploadbanfan=document.getElementById("img_uploadbanfan");
        var base64_code=document.getElementById("c-IDcardfrontpicturez");
        var img_area=document.getElementById("img_area");
        // 添加功能出发监听事件
        img_upload.addEventListener('change',readFile,false);
		img_uploadshenfenzngfan.addEventListener('change',readFilesfzf,false);
		img_uploadbanzheng.addEventListener('change',uploadbanzheng,false);
		img_uploadbanfan.addEventListener('change',uploadbanfan,false);
		
		}
        function readFile(){
            var file=this.files[0];
            if(!/image\/\w+/.test(file.type)){ 
                alert("请确保文件为图像类型"); 
                return false; 
            }
            var reader=new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(){
                $('#c-IDcardfrontpicturez').val( this.result);
                 
            }
        }
                function readFilesfzf(){
            var file=this.files[0];
            if(!/image\/\w+/.test(file.type)){ 
                alert("请确保文件为图像类型"); 
                return false; 
            }
            var reader=new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(){
                $('#c-IDcardreversepictures').val( this.result);
                 
            }
        }
    
	                function uploadbanzheng(){
            var file=this.files[0];
            if(!/image\/\w+/.test(file.type)){ 
                alert("请确保文件为图像类型"); 
                return false; 
            }
            var reader=new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(){
                $('#c-bankcardfrontpicture').val( this.result);
                 
            }
        }
		                function uploadbanfan(){
            var file=this.files[0];
            if(!/image\/\w+/.test(file.type)){ 
                alert("请确保文件为图像类型"); 
                return false; 
            }
            var reader=new FileReader();
            reader.readAsDataURL(file);
            reader.onload=function(){
                $('#c-bankcardreversepicture').val( this.result);
                 
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