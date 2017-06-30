/**
 * Created by Administrator on 2017/6/24.
 */
/*用户-删除*/
function user_del(obj, idField, id){
    var refreshPage = arguments[3] || false;
    layer.confirm('确认要删除吗？',function(index){
        $.ajax({
            type: "GET",
            url: "delete?id"+"="+id,
            dataType: "json",
            success: function(data){
                if (data == 'success'){
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon: 1,time:1000});
                    if (refreshPage) {
                        window.location.reload();
                    }
                }
                else {
                    var msg = data.info ? data.info : '删除失败，请稍后重试!';
                    layer.msg(msg,2);
                }
            }
        });
    });
}
