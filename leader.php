<?php
// 生命周期
define("SYS_TIME", microtime(true));
define('CMD', $argv[1]);

require __DIR__ . "/vendor/autoload.php";
App\pithy\Env::load_config('.env');

$console = [
    'debug' => function () {
        print_r('你好世界' . PHP_EOL);
    },
];
isset($console[CMD]) ? $console[CMD]() : print_r("command error" . PHP_EOL);
echo '执行时间' . (microtime(true) - SYS_TIME), PHP_EOL;