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
            <label class="form-label col-xs-2 col-sm-1"></label>
            <div class="formControls col-xs-9 col-sm-10">
                <div class="panel panel-secondary">
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="panel-header"> <?php echo ($v["f_name"]); ?></div>
                    <div class="panel-body">

                        <?php if(is_array($v["xj"])): $i = 0; $__LIST__ = $v["xj"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
                            <div class="panel-header">
                                <input type="checkbox" <?php if(($vv["select"]) == "1"): ?>checked<?php endif; ?> data-module="<?php echo ($v["id"]); ?>" data-id="<?php echo ($vv["id"]); ?>" data-type="ctrl"> <?php echo ($vv["f_name"]); ?>
                            </div>
                            <div class="panel-body">

                                <?php if(is_array($vv["xj"])): $i = 0; $__LIST__ = $vv["xj"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvv): $mod = ($i % 2 );++$i;?><input type="checkbox" <?php if(($vvv["select"]) == "1"): ?>checked<?php endif; ?> data-module="<?php echo ($v["id"]); ?>" data-id="<?php echo ($vvv["id"]); ?>" data-type="act"> <?php echo ($vvv["f_name"]); ?> &nbsp;<?php endforeach; endif; else: echo "" ;endif; ?>

                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>

                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-2 col-sm-offset-1">
                <button type="button" class="btn btn-primary" id="admin-role-save" name="admin-role-save">
                    <i class="icon-ok"></i> 确定
                </button>
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
    $(function () {

        var id = "<?php echo ($id); ?>";

        $('input').click(function () {
            var i = $(this);
            var type = i.attr('data-type');
            var check = i.prop('checked');
            if(type == 'ctrl')
            {
                if(check == true)
                {
                    i.parent().next().children().prop('checked',true);
                }else {
                    i.parent().next().children().prop('checked',false);
                }
            }
            if(type == 'act')
            {
                if(check == true)
                {
                    i.parent().prev().children().prop('checked',true);
                }else {
                    var all_act = i.parent().children();
                    var tmp = 0;
                    all_act.each(function () {
                        if($(this).prop('checked') == false)
                        {
                            tmp += 1;
                        }
                    });
                    if(tmp == all_act.length)
                    {
                        i.parent().prev().children().prop('checked',false);
                    }
                }
            }
        });

        $('#admin-role-save').click(function () {
            var all = $('input');
            var all_ids = [];
            all.each(function(){
                var i = $(this);
                if(i.prop('checked') == true)
                {
                    all_ids.push(i.attr('data-id'));
                    all_ids.push(i.attr('data-module'));
                }
            });
            layer.load();
            $.post('<?php echo U("role_add_permission");?>',{ids:all_ids.join(),id:id}, function (e) {
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