<?php init_head();

/**
 * @var $item App\pithy\BaseBean
 * @var $t_page int
 * @var $config array
 * @var $c_page int
 * @var $list array
 * @var $url_index string
 * @var $url_add string
 * @var $url_update string
 * @var $url_del string
 * @var $show_config array
 */

?>

<script>
    let url_index = '<?=$url_index?>';
    let url_add = '<?=$url_add?>';
    let url_update = '<?=$url_update?>';
    let url_del = '<?=$url_del?>';
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">列表</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <!--                        <li class="breadcrumb-item"><a href="#">一级目录</a></li>-->
                        <!--                        <li class="breadcrumb-item active">二级目录</li>-->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" onclick="window.location.href=url_add" class="btn btn-sm btn-primary">
                                新增
                            </button>
                            <button type="button" onclick="del_all()" class="btn btn-sm btn-danger">
                                批量删除
                            </button>
                            <div class="card-tools">

                                <div class="input-group input-group-sm">
                                    <select class="form-control" id="order_column"
                                            onchange="load_page(<?= intval($c_page) ?>)">
                                        <option value="0" <?= '0' == $_GET['order_by'] ? 'selected' : '' ?>>倒序
                                        </option>
                                        <option value="1" <?= '1' == $_GET['order_by'] ? 'selected' : '' ?>>正序
                                        </option>
                                    </select>
                                    <input type="text" name="search_title" value="<?= $_GET['search_title'] ?>"
                                           id="search_title" class="form-control float-right" placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="button" onclick="load_page(0)" class="btn btn-default"><i
                                                    class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="10px">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="check_all">
                                            <label for="check_all"></label>
                                        </div>
                                    </th>
                                    <?php foreach (array_values($show_config) ?: [] as $str): ?>
                                        <th><?= $str ?></th>
                                    <?php endforeach; ?>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" name="check_id" id="check_box_<?= $item->id ?>"
                                                       value="<?= $item->id ?>">
                                                <label for="check_box_<?= $item->id ?>"></label>
                                            </div>
                                        </td>
                                        <?php foreach (array_keys($show_config) ?: [] as $column): ?>
                                            <td><?= $item->$column ?></td>
                                        <?php endforeach; ?>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirm_del(url_del,{id:'<?= $item->id ?>'},common_reload)">
                                                删除
                                            </button>
                                            <button type="button" class="btn btn-sm btn-warning"
                                                    onclick="diy_turn_page(url_update+'?id=<?= $item->id ?>')">
                                                修改
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <?php diy_page($c_page, $t_page); ?>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!--<script src="/js/admin_index.js"></script>-->
<?php init_foot(); ?>
<script>
    // 翻页
    function load_page(page) {
        let order_by = $('#order_column').val();
        let search_title = $('#search_title').val();
        window.location.href = url_index + '?page=' + page + '&order_by=' + order_by + '&search_title=' + search_title;
    }

    function confirm_del(url, data, callback) {
        var r = confirm("是否确认删除");
        if (r === true) {
            common_post(url, data, callback);
        }
    }

    function del_all() {
        let ids = Array();
        $("input[name='check_id']:checked").each(function () {
            ids.push($(this).val());
        });
        console.log(ids);
        var r = confirm("是否确认删除");
        if (r !== true) return;
        if (0 === ids.length) return alert('请选择');
        common_post(url_del, {id: ids}, common_reload);
    }

    $(function () {
        //给Checkbox提供全选功能
        $("#check_all").click(function () {
            if (this.checked) {
                $("input[name='check_id']").each(function (index, obj) {
                    obj.checked = true;
                });
            } else {
                $("input[name='check_id']").each(function (index, obj) {
                    obj.checked = false;
                });
            }
        });
    });
</script>

