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

           //监听提交
           form.on('submit(formDemo)', function(data){
               layer.msg(JSON.stringify(data.field));
               return false;
           });
       });
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


    <div style="margin: 20px;">
        <form class="layui-form" action="addPost">
            <div class="layui-form-item">
                <label class="layui-form-label">名称</label>
                <div class="layui-input-block">
                    <input type="text" name="category_name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">顺序</label>
                <div class="layui-input-block">
                    <input type="text" name="display_order" required  lay-verify="required" placeholder="请输入显示顺序" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <textarea name="desc" placeholder="请输入描述" class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>
    </div>


<script type="text/javascript">
    var _CONTROLLER_ = '/index.php/ArticleCategory';
    var _ACTION_ = '/index.php/ArticleCategory/add';
    var _ROOT_ = '';
</script>

</body>
</html>