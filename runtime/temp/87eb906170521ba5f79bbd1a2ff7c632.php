<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:81:"/www/wwwroot/baidu.com/public/../application/admin/view/transferoffunds/edit.html";i:1566378276;s:65:"/www/wwwroot/baidu.com/application/admin/view/layout/default.html";i:1562338656;s:62:"/www/wwwroot/baidu.com/application/admin/view/common/meta.html";i:1562338656;s:64:"/www/wwwroot/baidu.com/application/admin/view/common/script.html";i:1562338656;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemtheaccount" data-rule="required" class="form-control" name="row[Redeemtheaccount]" type="text" value="<?php echo htmlentities($row['Redeemtheaccount']); ?>" disabled="disabled" />
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccouid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemtheaccouid" data-rule="required" class="form-control" name="row[Redeemtheaccouid]" type="number" value="<?php echo htmlentities($row['Redeemtheaccouid']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemintotheaccount" data-rule="required" class="form-control" name="row[Redeemintotheaccount]" type="text" value="<?php echo htmlentities($row['Redeemintotheaccount']); ?>">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccountid'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemintotheaccountid" data-rule="required" class="form-control" name="row[Redeemintotheaccountid]" type="number" value="<?php echo htmlentities($row['Redeemintotheaccountid']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Amount'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Amount" data-rule="required" class="form-control" name="row[Amount]" type="number" value="<?php echo htmlentities($row['Amount']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Handlingee'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Handlingee" data-rule="required" class="form-control" name="row[Handlingee]" type="number" value="<?php echo htmlentities($row['Handlingee']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccountqmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemtheaccountqmoney" class="form-control" name="row[Redeemtheaccountqmoney]" type="number" value="<?php echo htmlentities($row['Redeemtheaccountqmoney']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemtheaccounthmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemtheaccounthmoney" class="form-control" name="row[Redeemtheaccounthmoney]" type="number" value="<?php echo htmlentities($row['Redeemtheaccounthmoney']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccountqmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemintotheaccountqmoney" class="form-control" name="row[Redeemintotheaccountqmoney]" type="number" value="<?php echo htmlentities($row['Redeemintotheaccountqmoney']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Redeemintotheaccounthmoney'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-Redeemintotheaccounthmoney" class="form-control" name="row[Redeemintotheaccounthmoney]" type="number" value="<?php echo htmlentities($row['Redeemintotheaccounthmoney']); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Beizhu'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-beizhu" class="form-control" name="row[beizhu]" type="text" value="<?php echo htmlentities($row['beizhu']); ?>">
        </div>
    </div>
    <div class="form-group" style="display: none;">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Operator'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-operator" data-rule="required" class="form-control" name="row[operator]" type="text" value="<?php echo htmlentities($row['operator']); ?>,<?php echo $admin['username']; ?>">
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