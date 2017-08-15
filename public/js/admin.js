$(".post-audit").click(function (event) {

    target = $(event.target);//获取操作的元素
    var posts_id = target.attr('post-id');
    var status = target.attr('post-action-status');


    $.ajax({
        url: "/admin/posts/" + posts_id + "/status",
        method: 'POST',
        data: {'status': status},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.error != 0) {
                window.alert(data.msg);
                return;
            }
            target.parent().parent().remove();
        }
    });
});

$(".resource-delete").click(function (event) {

    if (window.confirm('确定执行删除的操作吗?') == false) {
        return;
    }

    var target = $(event.target);
    event.preventDefault();//阻止原来操作

    var url = $(target).attr("delete-url");

    $.ajax({
        url: url,
        method: 'POST',
        data: {"_method": "DELETE"},
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.error != 0) {
                window.alert(data.msg);
                return;
            }
            window.location.reload();
        }
    });
});