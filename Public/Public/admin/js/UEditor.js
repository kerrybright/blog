/**
 * Created by Administrator on 2016/7/14 0014.
 */
//百度编辑器。使用方法："id = editor"
$(function(){
    if ($('#editor').length > 0) {
        var ue = UE.getEditor('editor');

        function isFocus(e) {
            alert(UE.getEditor('editor').isFocus());
            UE.dom.domUtils.preventDefault(e);
        }

        $(function setContent() {
            ue.addListener("ready", function () {
                UE.getEditor('editor').setHeight(300);
            });
        });
    }
});