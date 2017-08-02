<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="/favicon.ico" >
    <link rel="Shortcut Icon" href="/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/static/back/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/static/back/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/static/back/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/static/back/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/back/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/static/back/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/static/back/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/static/back/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>后台管理</title>
</head>
<body>
<article class="page-container">
    <form action="" method="post" class="form form-horizontal" id="form-admin-role-add">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>功能名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>模块名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_module">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">控制器名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_controller">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">方法名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_action">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">功能排序：</label>
            <div class="formControls col-xs-3 col-sm-4">
                <input type="text" class="input-text" placeholder="请输入0-9999之间的数字" id="f_rand">
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="button" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
            </div>
        </div>

    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/back/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/back/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/back/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/back/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript">
    $(function(){

        $('#admin-role-save').click(function () {
            var f_name = $('#f_name').val();
            var f_module = $('#f_module').val();
            var f_controller = $('#f_controller').val();
            var f_action = $('#f_action').val();

            if(f_name.length < 2 || f_name.length > 10)
            {
                layer.alert('功能名称长度应在2-10之间', {icon: 5});
                return false;
            }

            if(f_module.length < 1 || f_module.length > 20)
            {
                layer.alert('模块名称长度应在1-20之间', {icon: 5});
                return false;
            }

            if(f_controller.length > 0 && f_controller.length > 20)
            {
                layer.alert('控制器名称长度应在1-20之间', {icon: 5});
                return false;
            }

            if(f_action.length > 0 && f_action.length > 20)
            {
                layer.alert('方法名称长度应在1-20之间', {icon: 5});
                return false;
            }

            layer.load(2);
            $.post('',{f_name:f_name,f_action:f_action,f_module:f_module,f_controller:f_controller}, function (e) {
                layer.closeAll('loading');
                if(e.status)
                {
                    window.parent.location.reload();
                }else {
                    layer.msg(e.info, {icon: 5});
                }
            })

        });
    });
</script>
</body>
</html>