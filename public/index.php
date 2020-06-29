<?php

// 入口时间
define("SYS_TIME", microtime(true));

// 本地测试可以使用php内置服务
// php -S 127001.run:8088 -t public public/index.php

// 生命周期
require __DIR__ . "/../vendor/autoload.php";

if (is_file(PUBLIC_ROOT . URI)) return false;

use App\pithy\Log;

// web uri
$router = require ROOT . "router.php";
isset($router[URI]) ? $router[URI]() : http_response_code(404);

Log::info((microtime(true) - SYS_TIME) . ':' . URI, "web_" . date('Ymd') . ".log");