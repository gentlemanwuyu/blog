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
function packageValidatorResponseText (text) {
    text = JSON.parse(text);
    var message = [];
    $.each(text, function (key, val) {
        $.each(val, function (vk, vv) {
            message.push(vv);
        });
    });
    return message.join('<br>');
}
