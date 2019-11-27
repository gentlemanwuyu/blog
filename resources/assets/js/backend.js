$('ul.layui-tab-title>li:first-child').addClass('layui-this');
$('div.layui-tab-content>div.layui-tab-item:first-child').addClass('layui-show');

// 给所有的ajax请求加上csrf_token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/**
 * 组装响应内容
 * @param text
 * @returns {string}
 */
var packageValidatorResponseText = function (text) {
    text = JSON.parse(text);
    var message = [];
    $.each(text, function (key, val) {
        $.each(val, function (vk, vv) {
            message.push(vv);
        });
    });
    return message.join('<br>');
}
    ,array_column = function (arr) {
    var obj = {};
    $.each(arr, function (key, val) {
        obj[val.name] = val.value;
    });

    return obj;
}
    ,previewImage = function (src) {
    var img = new Image()
        ,index = layer.load(2, {time: 0, scrollbar: false, shade: [0.02, '#000']});
    img.style.background = '#fff';
    img.style.display = 'none';
    img.src = src;
    document.body.appendChild(img);
    img.onerror = function () {
        layer.close(index);
    };
    img.onload = function () {
        layer.open({
            type: 1, shadeClose: true, success: img.onerror, content: $(img), title: false,
            area: img.width > 1140 ? '1140px' : img.width, closeBtn: 1, skin: 'layui-layer-nobg', end: function () {
                document.body.removeChild(img);
            }
        });
    };
}
