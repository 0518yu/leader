<?php

namespace App\pithy;

/**
 * Class Env
 * 放弃使用过于笨重的包
 * @package App\pithy
 */
class Env
{
    /**
     * 加载配置
     * 可以通过自定义函数 env() 获取
     * @param string $file
     */
    public static function load_config($file = '.env')
    {
        $file = ROOT . $file;
        if (!is_file($file)) return;
        $env = parse_ini_file($file, true);
        foreach ($env as $key => $val) {
            putenv("$key=$val");
            $_ENV[$key] = $val;
        }
    }
}