<?php
// 生命周期
use App\pithy\InitTable;
use App\pithy\Orm;
use App\s\MenuServer;

define("SYS_TIME", microtime(true));
define('CMD', $argv[1]);

require __DIR__ . "/vendor/autoload.php";

// 需要单独的配置
//App\pithy\Env::load_config('.env_console');

$console = [
    'debug' => function ($title = '首页') {
        print_r('你好世界' . PHP_EOL);
    }, 'init_table' => function () {
        (new InitTable())->init();
    }, 'init_beans' => function () {
        (new Orm())->init("App\m", ROOT . '/app/m/');
    }, 'fresh_url' => function () {
        $web = require __DIR__ . '/router.php';
        $s = new MenuServer();
        $s->fresh($web);
    }
];
isset($console[CMD]) ? $console[CMD]() : print_r("command error" . PHP_EOL);
echo '执行时间' . (microtime(true) - SYS_TIME), PHP_EOL;