<?php

namespace App\pithy;

/**
 * session使用文件，
 * 多个请求时会锁住Session文件，
 * 尽量在不用Session时尽早释放Session.
 * Class Session
 * @package Yu\core
 */
class Session
{
    // 保存session数据
    private static $session = null;

    public static function get($k)
    {
        self::init();
        return isset(self::$session[$k]) ? self::$session[$k] : null;
    }

    public static function del($k)
    {
        self::init();
        unset(self::$session[$k]);
    }

    public static function put($k, $v)
    {
        self::init();
        self::$session[$k] = $v;
        session_start(); //starts the session
        $_SESSION = self::$session;
        session_write_close();   // close write capability
    }

    /**
     * 初始化session数据
     */
    public static function init()
    {
        if (null === self::$session) {
            session_set_cookie_params(24 * 3600);
            session_start(); //starts the session
            null === $_SESSION && $_SESSION = [];
            self::$session = $_SESSION;
            session_write_close();   // close write capability
        }
    }
}