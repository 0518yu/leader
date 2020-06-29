<?php


namespace App\pithy;


class Log
{
    public static function info($msg, $file = null)
    {
        $file = null === $file ? "log_" . date('Y_m_d') . ".log" : $file;
        $content = is_array($msg) ? json_encode($msg, JSON_UNESCAPED_UNICODE) : $msg;
        file_put_contents(ROOT . "log/" . $file, $content . "\n", FILE_APPEND | LOCK_EX);
    }
}