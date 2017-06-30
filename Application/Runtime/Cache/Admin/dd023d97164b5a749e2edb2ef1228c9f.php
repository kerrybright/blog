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

    <link href="/Public/plugins/bootstrap/css/bootstrap.min.css?v=3.3.5" rel="stylesheet">
    <link href="/Public/plugins/layui-v1.0.9/css/layui.css?v=1.0.9" rel="stylesheet">
    <link href="/Public/css/index_admin.css?v=1.0" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">

    <script src="/Public/js/jquery.min.js?v=1.9.1"></script>
    <script src="/Public/js/index_admin.js?v=1.0"></script>
    <script src="/Public/plugins/bootstrap/js/bootstrap.min.js?v=3.3.5"></script>
    <script src="/Public/plugins/layui-v1.0.9/layui.js?v=3.3.5"></script>
    <!--[if IE 6]>
    <script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title><?php echo (C("SITE_NAME")); ?></title>
    <meta name="keywords" content="<?php echo (C("KEYWORDS")); ?>" />
    <meta name="description" content="<?php echo (C("DESCRIPTION")); ?>" />
</head>
<body style="background-color: #3c3c3c;">
    <div style="width: 100%;text-align: center;padding-top: 130px;">
        <div style="margin:0 auto;width:350px;padding-left:30px;height:200px;border-radius: 10px;border:1px white solid;box-shadow:3px 3px 8px #ffffff;text-align:left;color:white;padding-top: 20px;">
            <p style="text-align: center;padding-bottom: 10px;font-size: 23px;">Z博客后台管理</p>
            <form action="checkLogin" method="post">
                <p style="padding-left:30px;line-height: 25px;"><span>账号：</span>
                    <input style="border: none;background-color: #3c3c3c;border-bottom: 1px white solid;color:white;" name="user_account" type="text" value="" placeholder="账号">
                </p>
                <p style="padding-left:30px;line-height: 25px;"><span>密码：</span>
                    <input style="border: none;background-color: #3c3c3c;border-bottom: 1px white solid;color:white;" type="password" name=user_pwd value="" placeholder="密码">
                </p>
                <p style="padding-left:30px;padding-top: 15px;">
                    <input type="reset" style="background-color:#3c3c3c;width: 55px;height: 25px;border:1px white solid;border-radius: 5px;margin-right: 30px;color:white;" value="重置">
                    <input type="submit" style="background-color:#3c3c3c;width: 55px;height: 25px;border:1px white solid;border-radius: 5px;margin-right: 30px;color:white;" value="登录">
                </p>
            </form>
        </div>
    </div>
</body>
</html>