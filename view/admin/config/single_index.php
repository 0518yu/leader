<?php init_head();

/**
 * @var $list array
 * @var $item App\m\BeanConfig
 */

use App\c\admin\ConfigCon; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">简单配置</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">系统配置</a></li>
                        <li class="breadcrumb-item active">简单配置</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <form role="form" method="post" id="diy_form" action="<?= ConfigCon::SINGLE_SAVE ?>">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">常用</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php foreach (array_chunk($list, 3) as $_3): ?>
                            <div class="row">
                                <?php foreach ($_3 as $item): ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tmp_id_<?= $item->id ?>"><?= $item->title ?></label>
                                            <input type="hidden" name="id[]" value="<?= $item->id ?>">
                                            <input type="text" class="form-control" name="value[]"
                                                   value="<?= _($item->value) ?>" id="tmp_id_<?= $item->id ?>">
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <!-- /.row -->
                        <?php endforeach; ?>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">保存</button>
                    </div>
                </div>
                <!-- /.card -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </form>
    <!-- /.content -->
</div>
<!--<script src="/js/admin_index.js"></script>-->
<?php init_foot(); ?>

