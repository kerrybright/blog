<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="none">
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    
    <!--
<script src="/Public/js/jquery.min.js?v=1.9.1"></script>
-->
<script src="/Public/plugins/dist/js/lib/jquery-1.10.2.min.js"></script>
<script src="/Public/js/index_admin.js?v=1.0"></script>
<script src="/Public/plugins/bootstrap/js/bootstrap.min.js?v=3.3.5"></script>
<script src="/Public/plugins/layui-v1.0.9/layui.js?v=3.3.5"></script>
<script src="/Public/plugins/layer/layer.js"></script>
    <script type="text/javascript">

       layui.use('layer', function(){
           var layer = layui.layer;
       });

        function readArticle(obj){
            var content = $(obj).attr('data');
            layer.open({
                type: 1
                ,title: false //不显示标题栏
                ,closeBtn: false
                ,area: ['800px', '400px']
                ,shade: 0.8
                ,id: 'LAY_layuipro' //设定一个id，防止重复弹出
                ,btn: ['关闭']
                ,moveType: 1 //拖拽模式，0或者1
                ,content: content
            });
        }
    </script>

    
        <link href="/Public/plugins/bootstrap/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
<link href="/Public/plugins/layui-v1.0.9/css/layui.css?v=1.0.9" rel="stylesheet">
<link href="/Public/css/index_admin.css?v=1.0" rel="stylesheet">
<link href="/Public/admin/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    

    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo (C("SITE_NAME")); ?></title>
    <meta name="keywords" content="<?php echo (C("KEYWORDS")); ?>" />
    <meta name="description" content="<?php echo (C("DESCRIPTION")); ?>" />
    <!--百度编辑器-->
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:auto">


    <div style="padding: 10px;">
        <button class="layui-btn" onclick="layer.open({type: 2, area: ['800px', '400px'], fix: false, maxmin: true,content: 'add'});">添加<i class="layui-icon">&#xe608;</i></button>
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="200">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>文章编号</th>
                <th>文章标题</th>
                <th>作者</th>
                <th>文章内容</th>
                <th>禁用</th>
                <th>显示顺序</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($articleList)): foreach($articleList as $key=>$list): ?><tr>
                    <td><?php echo ($list['article_id']); ?></td>
                    <td><?php echo ($list['title']); ?></td>
                    <td><?php echo ($list['author']); ?></td>
                    <td>
                        <!--<?php echo ($list['content']); ?>-->
                        <button data="<?php echo ($list['content']); ?>" class="layui-btn" onclick="readArticle(this)"> <i class="layui-icon">&#xe608;</i></button>
                    </td>
                    <td><?php echo ($list['disabled']); ?></td>
                    <td><?php echo ($list['display_order']); ?></td>
                    <td><?php echo ($list['created_time']); ?></td>
                    <td></td>
                </tr><?php endforeach; endif; ?>

            </tbody>
        </table>
    </div>


<script type="text/javascript">
    var _CONTROLLER_ = '/index.php/Article';
    var _ACTION_ = '/index.php/Article/list';
    var _ROOT_ = '';
</script>

</body>
</html>