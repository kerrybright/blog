<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
    <title></title>
    <link href="/Public/plugins/dist/css/wangEditor.min.css?v=4.4.0" rel="stylesheet">
    <link href="/Public/plugins/bootstrap/css/bootstrap.min.css?v=1.0.9" rel="stylesheet">

    <!--引入jquery和wangEditor.js-->   <!--注意：javascript必须放在body最后，否则可能会出现问题-->
    <script src="/Public/plugins/dist/js/lib/jquery-1.10.2.min.js"></script>
    <script src="/Public/plugins/bootstrap/js/bootstrap.js?v=3.3.5"></script>
    <!--<script src="/Public/plugins/layer/layer.js"></script>-->
</head>
<body>
<div style="margin: 10px;">
    <form class="form-horizontal" action="addPost" id="article_form">
        <div class="form-group" style="margin-top: 10px;">
            <label for="name" class="col-sm-2 control-label">类别：</label>
            <div class="col-sm-10">
                <select class="form-control" name="position_id" id="position_id">
                    <option value="0">请选择类别</option>
                    <?php if(is_array($displayList)): foreach($displayList as $k=>$list): ?><option value="<?php echo ($k); ?>"><?php echo ($list); ?></option><?php endforeach; endif; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">文章：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="article_ids" id="article_ids" placeholder="文章">
            </div>
        </div>
        <div class="form-group">
            <label for="title" class="col-sm-2 control-label">描述:</label>
            <div class="col-sm-10">
                <textarea style="resize:none;" class="form-control" rows="3" name="desc" placeholder="描述"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label"></label>
            <div class="col-sm-10">
                <input type="submit" id="article_submit" value="提交" class="btn btn-primary">
                <input type="reset" value="重置" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
</body>
</html>