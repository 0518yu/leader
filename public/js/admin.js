let toast = null;
$(function () {
    toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000
    });
});
function common_reload() {
    window.location.reload();
}
function common_post(url,data,callback) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data,
        success: function (data) {
            var type = 'error';
            if (200 === data.status) {
                type = 'success';
                callback && setTimeout(function () {
                    callback(data);
                },1000);
            }
            toast.fire({
                type: type,
                title: data.msg,
            });
        },
        error: function (xhr, type) {
            console.log('Ajax error!');
        }
    });
}
// 获取form表单类型
function get_form_obj_data(form_id) {
    var data = $('#'+form_id).serializeArray();
    var obj = {};
    $.each(data, function (i, v) {
        obj[v.name] = v.value;
    });
    return obj;
}

// function diy_ajax_confirm(obj, data, success_opt) {
//     window.event.stopPropagation();
//     if (confirm("确认删除么")) {
//         diy_ajax(obj, data, success_opt);
//     }
//     return false;
// }
//
// function diy_ajax(obj, data, success_opt) {
//     window.event.stopPropagation();
//     var url = obj.dataset.src;
//     $.ajax({
//         type: 'POST',
//         url: url,
//         data: data,
//         dataType: 'json',
//         success: function (data) {
//             if (200 == data.status) {
//                 switch (success_opt) {
//                     case "reload":
//                         window.location.reload();
//                         break;
//                 }
//             } else {
//                 alert(data.msg);
//             }
//         },
//         error: function (xhr, type) {
//             console.log('Ajax error!');
//         }
//     });
//     return false;
// }
//
function diy_turn_page(url) {
    window.event.stopPropagation();
    window.location.href = url;
    return false;
}
//
function diy_turn_new_page(url) {
    window.event.stopPropagation();
    window.open(url);
}

function diy_upload_file(obj, callback) {
    window.event.stopPropagation();
    var fd = new FormData();
    fd.append("file", obj.files[0]);
    $.ajax({
        url: upload_url,
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType: 'json',
        success: function (d) {
            callback && callback(d);
        }
    });
}


function diy_upload_file_multi(obj, callback) {
    window.event.stopPropagation();
    var fd = new FormData();
    for(var i=0; i<obj.files.length;i++){
        fd.append("file[]", obj.files[i]);
    }
    $.ajax({
        url: upload_url,
        type: "POST",
        processData: false,
        contentType: false,
        data: fd,
        dataType: 'json',
        success: function (d) {
            // console.log(d);
            callback && callback(d);
        }
    });
}