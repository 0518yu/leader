<?php
// 自定义常量
// 目录相关
//define("SYS_TIME", m_time());
define("ROOT", __DIR__ . "/");
define('PUBLIC_ROOT', ROOT . 'public/');
define("TEMPLATE", ROOT . "view/");

// 功能相关
// 解析uri 此处可以修改为自定义方法处理 伪静态 等
define("URI", simple_uri());
define('SESSION_CAPTCHA', 'captcha');

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

function html()
{
    header("Content-Type: text/html; charset=utf-8");
    return true;
}