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
<nav class="breadcrumb">
    <i class="Hui-iconfont">&#xe67f;</i> 首页
    <span class="c-gray en">&gt;</span> 管理员管理
    <span class="c-gray en">&gt;</span> 角色管理
    <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.reload();" title="刷新" >
        <i class="Hui-iconfont">&#xe68f;</i>
    </a>
</nav>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <a class="btn btn-danger radius" id="dele">
                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
            </a>
            <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo U("add_role");?>','800')">
                <i class="Hui-iconfont">&#xe600;</i> 添加角色
            </a>
        </span>
        <span class="r">共有数据：<strong><?php echo ($num); ?></strong> 条</span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="6">角色管理</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
            <th width="40">ID</th>
            <th width="200">角色名</th>
            <th>用户列表</th>
            <th width="300">描述</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c">
            <td><input type="checkbox" value="<?php echo ($v["id"]); ?>" name="id"  class="location"></td>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><a href="#"></a></td>
            <td><?php echo ($v["remark"]); ?></td>
            <td class="f-14">
                <a title="配置权限" href="javascript:;" onclick="admin_role_edit('为“<?php echo ($v["name"]); ?>”配置权限','<?php echo U("role_add_function",['id'=>$v['id']]);?>','2')" style="text-decoration:none">
                <i class="Hui-iconfont">&#xe61d;&nbsp;</i>
                </a>
                <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','<?php echo U('access/mod_role');?>','1')" style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6df;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo ($v["id"]); ?>')" class="ml-5" style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6e2;</i>
                </a>
            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div style="margin-top: 10px;">
        <?php echo ($page); ?>
    </div>

</div>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/static/back/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/static/back/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/static/back/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/static/back/h-ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript" src="/static/back/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(function () {
        var data;

            $("#dele").click(function () {
                var data= new Array();
                var i = 0;
                $('.location').each(function (e) {

                   if($($('.location')[e]).is(':checked'))
                   {
                       data[i]= $($('.location')[e]).attr('value');
                       i=i+1;
                   }

                });
                    $.post('<?php echo U('Access/delete_all');?>',{id:data},function (e) {
                    layer.msg(e,{icon:1,time:1000});
                    setInterval(function () {
                        window.parent.location.reload();
                    },1000);

                })
                });
            }
        );
    function admin_role_add(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-角色-编辑*/
    function admin_role_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-角色-删除*/
    function admin_role_del(obj,id){
        layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: "<?php echo U('access/delete');?>",
                dataType: 'json',
                data:'id='+id,
                success: function(data){
                    $(obj).parents("tr").remove();
                    layer.msg(data,{icon:1,time:1000});
                },
                error:function(data) {
                    console.log(data.msg);

                },
            });
        });
    }
</script>
</body>
</html>