<?php

namespace App\s;

use App\m\BeanUsers;
use App\pithy\Session;

class UserServer
{
    //创建静态私有的变量保存该类对象
    /**
     * @var BeanUsers
     */
    static private $instance;

    //防止使用new直接创建对象
    private function __construct()
    {
    }

    //防止使用clone克隆对象
    private function __clone()
    {
    }

    /**
     * @return BeanUsers
     */
    static public function loginInfo()
    {
        //判断$instance是否是Singleton的对象，不是则创建
        if (!self::$instance instanceof BeanUsers) {
            $uid = (int)Session::get('session_key');
            $user = BeanUsers::getById($uid);
            self::$instance = $user;
        }
        return self::$instance;
    }
}