<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:77:"G:\WWW\xincaiwu\public/../application/admin\view\bankcardmanagement\edit.html";i:1570643913;s:58:"G:\WWW\xincaiwu\application\admin\view\layout\default.html";i:1562338656;s:55:"G:\WWW\xincaiwu\application\admin\view\common\meta.html";i:1562338656;s:57:"G:\WWW\xincaiwu\application\admin\view\common\script.html";i:1562338656;}*/ ?>
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
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Accountmanagementid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-accountmanagementID" data-rule="required" class="form-control" name="row[accountmanagementID]" type="number" value="<?php echo htmlentities($row['accountmanagementID']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" class="form-control" name="row[name]" type="text" value="<?php echo htmlentities($row['name']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Type'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-type" class="form-control" name="row[type]" type="text" value="<?php echo htmlentities($row['type']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Balance'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-balance" class="form-control" step="0.01" name="row[balance]" type="number" value="<?php echo htmlentities($row['balance']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDnumber" class="form-control " rows="5" name="row[IDnumber]" cols="50"><?php echo htmlentities($row['IDnumber']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Homeaddress'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Homeaddress" class="form-control " rows="5" name="row[Homeaddress]" cols="50"><?php echo htmlentities($row['Homeaddress']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Telephone'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-telephone" class="form-control " rows="5" name="row[telephone]" cols="50"><?php echo htmlentities($row['telephone']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Phonenumberstatus'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($phonenumberstatusList) || $phonenumberstatusList instanceof \think\Collection || $phonenumberstatusList instanceof \think\Paginator): if( count($phonenumberstatusList)==0 ) : echo "" ;else: foreach($phonenumberstatusList as $key=>$vo): ?>
            <label for="row[Phonenumberstatus]-<?php echo $key; ?>"><input id="row[Phonenumberstatus]-<?php echo $key; ?>" name="row[Phonenumberstatus]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['Phonenumberstatus'])?$row['Phonenumberstatus']:explode(',',$row['Phonenumberstatus']))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Bankcardnumber" class="form-control " rows="5" name="row[Bankcardnumber]" cols="50"><?php echo htmlentities($row['Bankcardnumber']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Subbankcardnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-subBankcardnumber" class="form-control " rows="5" name="row[subBankcardnumber]" cols="50"><?php echo htmlentities($row['subBankcardnumber']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Loginaccount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Loginaccount" class="form-control " rows="5" name="row[Loginaccount]" cols="50"><?php echo htmlentities($row['Loginaccount']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Loginpassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-loginpassword" class="form-control " rows="5" name="row[loginpassword]" cols="50"><?php echo htmlentities($row['loginpassword']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Ushieldpassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Ushieldpassword" class="form-control " rows="5" name="row[Ushieldpassword]" cols="50"><?php echo htmlentities($row['Ushieldpassword']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Withdrawalspassword'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Withdrawalspassword" class="form-control " rows="5" name="row[Withdrawalspassword]" cols="50"><?php echo htmlentities($row['Withdrawalspassword']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcardfrontpicturez'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDcardfrontpicturez" class="form-control " rows="5" name="row[IDcardfrontpicturez]" cols="50"><?php echo htmlentities($row['IDcardfrontpicturez']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Idcardreversepictures'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-IDcardreversepictures" class="form-control " rows="5" name="row[IDcardreversepictures]" cols="50"><?php echo htmlentities($row['IDcardreversepictures']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardfrontpicture'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-bankcardfrontpicture" class="form-control " rows="5" name="row[bankcardfrontpicture]" cols="50"><?php echo htmlentities($row['bankcardfrontpicture']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bankcardreversepicture'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-bankcardreversepicture" class="form-control " rows="5" name="row[bankcardreversepicture]" cols="50"><?php echo htmlentities($row['bankcardreversepicture']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Cardstatus'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Cardstatus" class="form-control " rows="5" name="row[Cardstatus]" cols="50"><?php echo htmlentities($row['Cardstatus']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Remarks'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-Remarks" class="form-control " rows="5" name="row[Remarks]" cols="50"><?php echo htmlentities($row['Remarks']); ?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Numberofalipays'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-NumberofAlipays" class="form-control" name="row[NumberofAlipays]" type="number" value="<?php echo htmlentities($row['NumberofAlipays']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Numberofwechat'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-NumberofWeChat" class="form-control" name="row[NumberofWeChat]" type="number" value="<?php echo htmlentities($row['NumberofWeChat']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isopenwechat'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-IsopenWeChat" class="form-control selectpicker" name="row[IsopenWeChat]">
                <?php if(is_array($isopenwechatList) || $isopenwechatList instanceof \think\Collection || $isopenwechatList instanceof \think\Paginator): if( count($isopenwechatList)==0 ) : echo "" ;else: foreach($isopenwechatList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['IsopenWeChat'])?$row['IsopenWeChat']:explode(',',$row['IsopenWeChat']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Isopenalipay'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-IsopenAlipay" data-rule="required" class="form-control selectpicker" name="row[IsopenAlipay]">
                <?php if(is_array($isopenalipayList) || $isopenalipayList instanceof \think\Collection || $isopenalipayList instanceof \think\Paginator): if( count($isopenalipayList)==0 ) : echo "" ;else: foreach($isopenalipayList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['IsopenAlipay'])?$row['IsopenAlipay']:explode(',',$row['IsopenAlipay']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Dateofpurchase'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Dateofpurchase" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[Dateofpurchase]" type="text" value="<?php echo $row['Dateofpurchase']; ?>">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Administrator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-administrator" class="form-control" name="row[administrator]" type="text" value="<?php echo htmlentities($row['administrator']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Shieldnumber'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Shieldnumber" class="form-control" name="row[Shieldnumber]" type="number" value="<?php echo htmlentities($row['Shieldnumber']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Yanzhengjizhi'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-yanzhengjizhi" class="form-control selectpicker" name="row[yanzhengjizhi]">
                <?php if(is_array($yanzhengjizhiList) || $yanzhengjizhiList instanceof \think\Collection || $yanzhengjizhiList instanceof \think\Paginator): if( count($yanzhengjizhiList)==0 ) : echo "" ;else: foreach($yanzhengjizhiList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), is_array($row['yanzhengjizhi'])?$row['yanzhengjizhi']:explode(',',$row['yanzhengjizhi']))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>