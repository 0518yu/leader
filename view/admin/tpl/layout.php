<?php function init_head(){ ?><!DOCTYPE html>
<html lang="zh">
<?php include TEMPLATE . 'admin/tpl/head.php'; ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include __DIR__ . "/nav.php"; ?>
    <?php include __DIR__ . "/menu.php"; ?>
    <?php } ?>

    <?php function init_foot(){ ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2020-<?=date('Y')?> <a href="https://github.com/0518yu/leader">frame-php-free</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 1.0.0
        </div>
    </footer>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
</body>
<?php include TEMPLATE . 'admin/tpl/foot_script.php'; ?>
</html>
<?php }