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
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>学校名称：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_name">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>联系方式：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="固话或者手机号，固话请不要带“-”" id="f_contact">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>联系人：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_contacts">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>地址：</label>
            <div class="formControls col-xs-7 col-sm-8">
                <input type="text" class="input-text" value="" placeholder="" id="f_address">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">* </span>所在地区：</label>
            <div class="formControls col-xs-3 col-sm-4">
                <span class="select-box">
                    <select class="select" id="area">
                        <?php echo ($option); ?>
                    </select>
                </span>
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
            var name = $('#f_name').val();
            var contact = $('#f_contact').val();
            var contacts = $('#f_contacts').val();
            var address = $('#f_address').val();
            var region = $('#area').val();

            if(name.length < 2 || name.length > 20)
            {
                layer.msg('功能名称长度应在2-20之间', {time:2000,icon: 5});
                $('#f_name').focus();
                return false;
            }
            var rex0 = /-/;
            if(rex0.test(contact))
            {
                contact = contact.replace('-','');
                $('#f_contact').val(contact);
            }
            var rex = /^1[3,5,7,8]\d{9}|0(10|20|21|22|23|24|25|27|28|29)[1-9]\d{6,7}|0[3-9]\d{2}[1-9]\d{6,7}$/;
            if(!rex.test(contact))
            {
                $('#f_contact').focus();
                layer.msg('请输入正确的联系方式', {time:2000,icon: 5});
                return false;
            }
            layer.load(2);
            $.post('<?php echo U("add_school");?>',{name:name,contact:contact,contacts:contacts,address:address,region:region}, function (e) {
                //console.log(e);
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