function do_login() {
    let obj = get_form_obj_data('login_form');
    common_post('', obj, function (data) {
        window.location.href = data.url;
    });
}

function load_captcha() {
    $.ajax({
        type: 'POST',
        url: '/captcha',
        success: function (data) {
            $('#captcha').html(data);
        },
        error: function (xhr, type) {
            console.log('Ajax error!');
        }
    });
}

$(load_captcha);