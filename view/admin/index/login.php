<!DOCTYPE html>
<html lang="zh">
<?php include TEMPLATE . 'admin/tpl/head.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo"><a href="/"><b><?= env('app_name') ?></b>后台</a></div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">请登录</p>
            <form action="" id="login_form" method="post">
                <div class="input-group mb-3">
                    <input type="text" name="account" class="form-control" placeholder="账号">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="密码">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <div class="row" id="captcha"></div>
                <div class="input-group mb-3"></div>
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <button type="button" onclick="do_login()" class="btn btn-primary btn-block btn-flat">登录</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
<?php include TEMPLATE . 'admin/tpl/foot_script.php'; ?>
<script src="/js/login.js"></script>
</body>
</html>
