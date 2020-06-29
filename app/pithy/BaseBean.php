<?php

namespace App\pithy;

/**
 * Class BaseBean
 * @property $id
 * @package App\s
 */
class BaseBean
{
    const TABLE = "";

    /**
     * @param $id
     * @return $this
     */
    public static function getById($id)
    {
        $db = new BeanPDO(get_called_class());
        $info = $db->selectOne(['id' => $id]);
        return $info;
    }

    /**
     * @param $where
     * @return $this
     */
    public static function queryOne($where)
    {
        $db = new BeanPDO(get_called_class());
        $info = $db->selectOne($where);
        return $info;
    }

    public function config($column)
    {
        $fun = "get_{$column}_rule";
        $str = $this->$fun();
        $str = explode(':', $str);
        if (!isset($str[2])) return [];

        $list = explode(',', $str[2]);
        $config = [];
        foreach ($list as $item) {
            list($k, $v) = explode('#', $item);
            $config[$k] = $v;
        }
        return $config;
    }
}