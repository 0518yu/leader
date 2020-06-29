<?php
namespace App\m;

use App\pithy\BaseBean;
/**
 * Class BeanUsers
 * Bean class for object oriented management of the MySQL table users
 *
 * Comment of the managed table users: 用户表.
 *
 * @extends 
 * @filesource BeanUsers.php
 * @category MySql Database Bean Class
 * @package App\m
 * @author frame-php-free <>
 * @copyright (c) 2020 frame-php-free <> - All rights reserved. See LICENSE file
*/
class BeanUsers extends BaseBean
{

    /**
     * @example 用户表
     */
    const TABLE = "users";
    public function getTableRule()
    {
        return '用户表';
    }

    /**
     * id
     * @example index_show,except_admin:id
     * @var int $id
     */
    public $id;
    public function get_id_rule()
    {
        return 'index_show,except_admin:id';
    }

    /**
     * name
     * @example index_show,add_post,update_post,form_text:姓名:
     * @var string $name
     */
    public $name;
    public function get_name_rule()
    {
        return 'index_show,add_post,update_post,form_text:姓名:';
    }

    /**
     * password
     * @example add_post,update_post,form_text:密码:
     * @var string $password
     */
    public $password;
    public function get_password_rule()
    {
        return 'add_post,update_post,form_text:密码:';
    }

    /**
     * account
     * @example index_show,add_post,update_post,form_text:账号:
     * @var string $account
     */
    public $account;
    public function get_account_rule()
    {
        return 'index_show,add_post,update_post,form_text:账号:';
    }

    /**
     * r_id
     * @example add_post,update_post,form_select,filter_role:角色:1#管理员,2#店长,6#用户
     * @var int $r_id
     */
    public $r_id;
    public function get_r_id_rule()
    {
        return 'add_post,update_post,form_select,filter_role:角色:1#管理员,2#店长,6#用户';
    }

    /**
     * status
     * @example add_post,update_post,form_select:状态:1#正常,9#封号
     * @var int $status
     */
    public $status;
    public function get_status_rule()
    {
        return 'add_post,update_post,form_select:状态:1#正常,9#封号';
    }

    /**
     * created_at
     * @example index_show,add_date_time:创建时间
     * @var string $created_at
     */
    public $created_at;
    public function get_created_at_rule()
    {
        return 'index_show,add_date_time:创建时间';
    }

    /**
     * updated_at
     * @example add_date_time,update_date_time:修改时间
     * @var string $updated_at
     */
    public $updated_at;
    public function get_updated_at_rule()
    {
        return 'add_date_time,update_date_time:修改时间';
    }

}
?>
