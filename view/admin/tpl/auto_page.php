<?php init_head();
/**
 * @var $page_name string
 * @var $page_name_list array
 * @var $form App\s\TplForm
 */
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?= $page_name ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <?php foreach ($page_name_list as $item) { ?>
                            <li class="breadcrumb-item <?= end($page_name_list) == $item ? 'active' : '' ?>"><?= $item ?></li>
                        <?php } ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php isset($form) && $form->format(); ?>
    <!--    其他表单    -->
    <?php foreach (isset($other_forms) ? $other_forms : [] as $form): ?>
        <?php isset($form) && $form->format(); ?>
    <?php endforeach; ?>
</div>
<?php init_foot(); ?>
<script>
    // 初始化
    $(function () {
        for (let i = 0; i < init_call.length; i++) {
            init_call[i]();
        }
    });
</script>
