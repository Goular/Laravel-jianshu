$(".like-button").click(function (event) {
    var target = $(event.target);
    var current_like = target.attr('like-value');
    var user_id = target.attr('like-user');
    var type = target.attr('like-type');
    var url = '';
    if (current_like == 1) {
        if(type == 1){
            url = '/user/' + user_id + "/unfan"
        }else if(type == 2){
            url = '/user/' + user_id + "/unstar"
        }
        //取消关注
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0) {
                    window.alert(data.msg);
                    return;
                }
                target.attr('like-value', 0);
                target.text('关注');
            }
        });
    } else {
        if(type == 1){
            url = '/user/' + user_id + "/fan"
        }else if(type == 2){
            url = '/user/' + user_id + "/star"
        }
        //添加关注
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/user/' + user_id + "/fan",
            method: 'POST',
            dataType: 'json',
            success: function (data) {
                if (data.error != 0) {
                    window.alert(data.msg);
                    return;
                }
                target.attr('like-value', 1);
                target.text('取消关注');
            }
        });
    }
});





var editor = new wangEditor('content');

// 上传图片（举例）
editor.config.uploadImgUrl = '/posts/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};

// 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
//editor.config.hideLinkImg = true;

editor.create();
