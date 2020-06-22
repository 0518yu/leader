<?php
define("SYS_TIME", microtime(true));

// 本地测试可以使用php内置服务
// php -S xxx.xxx.xxx:8088 -t public public/index.php

// 生命周期
require __DIR__ . "/../vendor/autoload.php";

if (is_file(PUBLIC_ROOT . URI)) return false;

App\pithy\Env::load_config('.env');

// web uri
$router = require ROOT . "router.php";
isset($router[URI]) ? $router[URI]() : http_response_code(404);