<?php
define("ROOT", __DIR__ . "/");
App\pithy\Env::load_config('.env');// 需要ROOT
// 获取 env 数据
function env($key, $default = '')
{
    $value = getenv($key);
    return false === $value ? $default : $value;
}

// 获取当前请求路由
function simple_uri()
{
    $uri = isset($_SERVER["REQUEST_URI"]) ? $_SERVER["REQUEST_URI"] : '';
    return current(explode("?", $uri));
}

function is_post()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function get_pass($str, $cost = 10)
{
    return password_hash($str, PASSWORD_BCRYPT, ["cost" => $cost]);
}

function check_pass($pass, $hash)
{
    return password_verify($pass, $hash);
}

// 防止用户输入的html 或者js代码执行
function _($value)
{
    return htmlspecialchars($value,ENT_QUOTES);
}

function underscoreToCamelCase($string, $pascalCase = false)
{
    $string = strtolower($string);

    if ($pascalCase == true) {
        $string[0] = strtoupper($string[0]);
    }
    $func = function ($c) {
        return strtoupper($c[1]);
    };
    return preg_replace_callback("/_([a-z])/", $func, $string);
}

// 常量配置
define('PUBLIC_ROOT', ROOT . 'public/');
define("TEMPLATE", ROOT . "view/");
define("QN_HOST", env('qn_host'));

// 功能相关
// 解析uri 此处可以修改为自定义方法处理 伪静态 等
define("URI", simple_uri());
define('SESSION_CAPTCHA', 'captcha');
