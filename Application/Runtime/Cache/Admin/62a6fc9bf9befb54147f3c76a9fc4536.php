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
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <a href="javascript:;" id="ddd" class="btn btn-danger radius">
                <i class="Hui-iconfont">&#xe6e2;</i> 批量删除
            </a>
            <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_add('添加角色','<?php echo U("add_school");?>','800')">
                <i class="Hui-iconfont">&#xe600;</i> 添加学校
            </a>
        </span>
        <span class="r">共有数据：<strong><?php echo ($num); ?></strong> 条</span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg">
        <thead>
        <tr>
            <th scope="col" colspan="8">功能节点管理</th>
        </tr>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
            <th width="40">ID</th>
            <th width="200">学校名称</th>
            <th>联系方式</th>
            <th>联系人</th>
            <th>学校地址</th>
            <th>所在地区</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr class="text-c  ">
            <td><input type="checkbox" value="" name="" class="delet" data-id="<?php echo ($v["uid"]); ?>"></td>
            <td><?php echo ($v["uid"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php echo ($v["contact"]); ?></td>
            <td><?php echo ($v["contacts"]); ?></td>
            <td><?php echo ($v["address"]); ?></td>
            <td><?php echo ($v["area"]); ?></td>
            <td class="f-14">
                <a title="编辑" href="javascript:;" onclick="admin_role_edit('角色编辑','<?php echo U('edit_school',[id => $v['uid']]);?>','<?php echo ($v["uid"]); ?>')" style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6df;</i>
                </a>
                <a title="删除" href="javascript:;" onclick="admin_role_del(this,'<?php echo ($v["uid"]); ?>')" class="ml-5" style="text-decoration:none">
                    <i class="Hui-iconfont">&#xe6e2;</i></a></td>
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
    /*管理员-角色-添加*/
    function admin_role_add(title,url,w,h){
        layer_show(title,url,w,h);
    }
    /*管理员-角色-编辑*/
    function admin_role_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
    $(function () {
        var ids=[];
       $('#ddd').on('click',function () {
           $('.delet').each(function () {
               if($(this).prop('checked'))
               {
                   ids.push($(this).attr('data-id'));
               }
           })
          $.post('<?php echo U('school/delete_all');?>',{ids:ids},function (e) {
              console.log(e);
//               if(e.sattus)
//               {
//                   $(this).parent().parents("tr").remove();
//                   layer.msg(e.info,{icon:1,time:1000});
//               }
           })
       })
    });

    /*管理员-角色-删除*/
    function admin_role_del(obj,id){
        layer.confirm('角色删除须谨慎，确认要删除吗？',function(index){
            $.ajax({
                type: 'POST',
                url: '<?php echo U('delete_school');?>',
                dataType: 'json',
                data:{id:id},
                success: function(data){
                    if(data.status)
                    {
                        $(obj).parents("tr").remove();
                        layer.msg(data.info,{icon:1,time:1000});
                    }else
                    {
                    layer.msg(data.info,{icon:1,time:1000});
                    }
                },
            });
        });
    }
</script>
</body>
</html>