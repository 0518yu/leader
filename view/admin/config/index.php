<?php init_head();

/**
 * @var $item App\m\BeanConfigList
 * @var $t_page int
 * @var $config array
 * @var $c_page int
 * @var $list array
 */

use App\c\admin\ConfigCon; ?>

<script>
    let url_index = '<?=ConfigCon::INDEX?>';
    let url_add = '<?=ConfigCon::ADD?>';
    let url_update = '<?=ConfigCon::UPDATE?>';
    let url_del = '<?=ConfigCon::DEL?>';
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
                        <li class="breadcrumb-item"><a href="#">系统配置</a></li>
                        <li class="breadcrumb-item active">复杂配置</li>
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
                            <div class="card-tools">
                                <?php diy_page($c_page, $t_page); ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th style="width: 10px">id</th>
                                    <th>名称</th>
                                    <th>分类</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($list as $item): ?>
                                    <tr>
                                        <td><?= $item->id ?></td>
                                        <td><?= $item->title ?></td>
                                        <td><?= $config[$item->type] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary"
                                                    onclick="common_post(url_del,{id:'<?= $item->id ?>'},common_reload)">
                                                删除
                                            </button>
                                            <button type="button" class="btn btn-sm btn-primary"
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

