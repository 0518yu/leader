<?php
namespace App\m;

use App\pithy\BaseBean;
/**
 * Class BeanConfig
 * Bean class for object oriented management of the MySQL table config
 *
 * Comment of the managed table config: :配置表.
 *
 * @extends 
 * @filesource BeanConfig.php
 * @category MySql Database Bean Class
 * @package App\m
 * @author frame-php-free <>
 * @copyright (c) 2020 frame-php-free <> - All rights reserved. See LICENSE file
*/
class BeanConfig extends BaseBean
{

    /**
     * @example :配置表
     */
    const TABLE = "config";
    public function getTableRule()
    {
        return ':配置表';
    }

    /**
     * id
     * @example 
     * @var int $id
     */
    public $id;
    public function get_id_rule()
    {
        return '';
    }

    /**
     * title
     * @example :名称
     * @var string $title
     */
    public $title;
    public function get_title_rule()
    {
        return ':名称';
    }

    /**
     * value
     * @example form#text:值
     * @var string $value
     */
    public $value;
    public function get_value_rule()
    {
        return 'form#text:值';
    }

    /**
     * type
     * @example 常量
     * @var int $type
     */
    public $type;
    public function get_type_rule()
    {
        return '常量';
    }

    /**
     * created_at
     * @example 
     * @var string $created_at
     */
    public $created_at;
    public function get_created_at_rule()
    {
        return '';
    }

    /**
     * updated_at
     * @example 
     * @var string $updated_at
     */
    public $updated_at;
    public function get_updated_at_rule()
    {
        return '';
    }

}
?>
