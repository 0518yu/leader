$(function () {
    // 拖动排序
    // jQuery UI sortable for the todo list
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999,
        update: function (event, ui) {
            // 保存排序
            var ids = Array();
            $('.todo_li').each(function (index, element) {
                ids.push($(element).data('id'));
            });
            common_post(
                url_update,
                {ids: ids, 'type': 'sort'},
                common_reload
            );
        }
    });

});

// 翻页
function load_page(page) {
    window.location.href = url_index + '?page=' + page;
}

// 删除
var del_id = 0;

function set_id(id) {
    del_id = id;
}

function del() {
    common_post(url_del, {id: del_id}, common_reload);
}

// 设置是否完成
function set_done(obj) {
    common_post(url_update, {id: $(obj).val(), is_deal: $(obj).is(':checked') ? 1 : 0});
}

// 新增
function do_add_task() {
    var obj = get_form_obj_data('new_task_form');
    common_post(url_add, obj, function () {
        load_page(0);
    });
}