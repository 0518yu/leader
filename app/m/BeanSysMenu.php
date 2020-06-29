<?php
namespace App\m;

use App\pithy\BaseBean;
/**
 * Class BeanSysMenu
 * Bean class for object oriented management of the MySQL table sys_menu
 *
 * Comment of the managed table sys_menu: :系统菜单.
 *
 * @extends 
 * @filesource BeanSysMenu.php
 * @category MySql Database Bean Class
 * @package App\m
 * @author frame-php-free <>
 * @copyright (c) 2020 frame-php-free <> - All rights reserved. See LICENSE file
*/
class BeanSysMenu extends BaseBean
{

    /**
     * @example :系统菜单
     */
    const TABLE = "sys_menu";
    public function getTableRule()
    {
        return ':系统菜单';
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
     * pid
     * @example :上级目录
     * @var int $pid
     */
    public $pid;
    public function get_pid_rule()
    {
        return ':上级目录';
    }

    /**
     * title
     * @example :标题
     * @var string $title
     */
    public $title;
    public function get_title_rule()
    {
        return ':标题';
    }

    /**
     * url
     * @example :url
     * @var string $url
     */
    public $url;
    public function get_url_rule()
    {
        return ':url';
    }

    /**
     * icon
     * @example :图标
     * @var string $icon
     */
    public $icon;
    public function get_icon_rule()
    {
        return ':图标';
    }

    /**
     * rids
     * @example :授权角色
     * @var string $rids
     */
    public $rids;
    public function get_rids_rule()
    {
        return ':授权角色';
    }

    /**
     * uids
     * @example :授权用户
     * @var string $uids
     */
    public $uids;
    public function get_uids_rule()
    {
        return ':授权用户';
    }

    /**
     * is_menu
     * @example :是否是菜单: 1是 0 不是
     * @var int $is_menu
     */
    public $is_menu;
    public function get_is_menu_rule()
    {
        return ':是否是菜单: 1是 0 不是';
    }

    /**
     * status
     * @example :状态:1是正常 0禁用
     * @var int $status
     */
    public $status;
    public function get_status_rule()
    {
        return ':状态:1是正常 0禁用';
    }

    /**
     * display_order
     * @example :排序
     * @var int $display_order
     */
    public $display_order;
    public function get_display_order_rule()
    {
        return ':排序';
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
