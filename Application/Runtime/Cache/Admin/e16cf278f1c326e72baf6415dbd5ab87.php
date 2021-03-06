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
    <form class="form-horizontal" action="addPost" id="article_form" method="post">
        <!--<textarea style="width: 100%;height: 300px;" id="textarea1" name="content"></textarea>-->
        <textarea style="width:100%; height:500px;"  type="text"  name="content" id="EditorId" placeholder="请输入内容"></textarea>
        <div class="form-group" style="margin-top: 10px;">
            <label for="title" class="col-sm-2 control-label">标题：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="请输入名字">
            </div>
        </div>
        <div class="form-group" style="margin-top: 10px;">
            <label for="author" class="col-sm-2 control-label">作者：</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="author" id="author" placeholder="请输入名字">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">类别：</label>
            <div class="col-sm-10">
                <select class="form-control" name="category_id" id="category_id">
                    <option value="0">请选择类别</option>
                    <?php if(is_array($categoryList)): foreach($categoryList as $key=>$list): ?><option value="<?php echo ($list['category_id']); ?>"><?php echo ($list['category_name']); ?></option><?php endforeach; endif; ?>
                </select>
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
<!--<script src="/Public/plugins/dist/js/wangEditor.min.js"></script>-->
<!--<script type="text/javascript">
    // 获取元素
    var textarea = document.getElementById('textarea1');
    // 生成编辑器
    var editor = new wangEditor(textarea);
    editor.create();

    $('#article_submit').click(function(){
        if(!$('#title').val()){
            alert("请输入标题");
        }

        //创建编辑器
        var contentHtml = editor.$txt.html();
        $('#textarea1').val(contentHtml);

        $("#article_form").submit();
    });

</script>-->
<script type="text/javascript" charset="utf-8" src="/Public/plugins/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/plugins/ueditor/ueditor.all.js"></script>
<script type="text/javascript" charset="utf-8">
    window.UEDITOR_HOME_URL = "Public/admin/ueditor/";//配置路径设定为UEditor所放的位置
    window.onload=function(){
//        window.UEDITOR_CONFIG.initialFrameHeight=300;//编辑器的高度
//        window.UEDITOR_CONFIG.initialFrameWidth=500;//编辑器的宽度
        var editor = new UE.ui.Editor({
            imageUrl : '/index.php/Editor/uploadImage',
            fileUrl : '/index.php/Editor/uploadFile',
            imagePath : '',
            filePath : '',
            imageManagerUrl:'/index.php/Editor/imageManage', //图片在线管理的处理地址
            imageManagerPath:'/'
        });
        editor.render("EditorId");//此处的EditorId与<textarea name="content" id="EditorId">的id值对应 </textarea>
    }
</script>
</body>
</html>