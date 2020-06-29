<?php


namespace App\s;


use App\m\BeanConfig;
use App\pithy\BeanPDO;

class SingleConfigServer
{
    //创建静态私有的变量保存该类对象
    /**
     * @var array
     */
    static private $list = null;
    static private $map = null;

    //防止使用new直接创建对象
    private function __construct()
    {
    }

    //防止使用clone克隆对象
    private function __clone()
    {
    }

    private static function init()
    {
        /**
         * @var $v BeanConfig
         */
        //判断$instance是否是Singleton的对象，不是则创建
        if (!is_array(self::$list)) {
            $db = new BeanPDO(BeanConfig::class);
            $table = BeanConfig::TABLE;
            $list = $db->queryObjList(/** @lang text */"select * from $table", []);
            self::$list = $list;
            $map = [];
            foreach ($list as $k => $v) $map[$v->id] = $v;
            self::$map = $map;
        }
    }

    /**
     * @return array
     */
    public static function getList()
    {
        self::init();
        return self::$list;
    }

    /**
     * @param $key
     * @return BeanConfig
     */
    public static function one($key)
    {
        self::init();
        return self::$map[$key];
    }

}