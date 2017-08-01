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