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
<link rel="stylesheet" href="/static/back/layui/css/layui.css" media="all">
<style>
    .tree-row
    {
        padding: 0;margin: 0; float: right; width: 700px;
        border-bottom: dotted 1px #ccc;
        height: 30px;
    }

    .layui-tree li a{
        height: 40px;;
    }


</style>
<div class="page-container">
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <a class="btn btn-primary radius" href="javascript:;" onclick="admin_role_edit('添加地区','<?php echo U('add_region');?>',3,'800')">
                <i class="Hui-iconfont">&#xe600;</i> 添加省份
            </a>
        </span>
    </div>
    <div style=" padding: 10px; min-width: 800px; border: 1px solid #ddd; overflow: auto;">
        <ul id="tree"></ul>
    </div>
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
<script type="text/javascript" src="/static/back/layui/layui.js"></script>
<script type="text/javascript">

    layui.use(['tree', 'layer'], function(){
        var layer = layui.layer
                ,$ = layui.jquery;

        layui.tree({
            elem: '#tree' //指定元素
            ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
            ,nodes: <?php echo ($list); ?>
        });

    });


    $(function () {
        $('#tree').on('click','.del',function () {
            var i = $(this);
            layer.confirm('确认要删除吗？',function(index){
                if(index)
                {
                    layer.load(2);
                    var id = i.parent().attr('data-id');
                    $.post('<?php echo U("delete_region");?>',{id:id}, function (e) {
                        console.log(e);
                        layer.closeAll('loading');
                        layer.close(index);
                        if(e.status)
                        {
                            i.parent().parent().parent().parent().remove();
                        }else {
                            layer.msg(e.info, {icon: 5});
                        }
                    })
                }
            });
        });

        $('#tree').on('click','.edit',function () {
            //var id = $(this).parent().attr('data-id');
            var url = $(this).attr('data-url');
            admin_role_edit('编辑', url,2,800)
        });


        $('#tree').on('click','.add',function () {
            var url = $(this).attr('data-url');
            admin_role_edit('添加“'+$(this).parent().attr('data-name')+'”的下级',url,'1');
        });

    });
    /*编辑*/
    function admin_role_edit(title,url,id,w,h){
        layer_show(title,url,w,h);
    }
</script>
</body>
</html>