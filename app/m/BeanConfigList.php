<?php
namespace App\m;

use App\pithy\BaseBean;
/**
 * Class BeanConfigList
 * Bean class for object oriented management of the MySQL table config_list
 *
 * Comment of the managed table config_list: :复杂配置.
 *
 * @extends 
 * @filesource BeanConfigList.php
 * @category MySql Database Bean Class
 * @package App\m
 * @author frame-php-free <>
 * @copyright (c) 2020 frame-php-free <> - All rights reserved. See LICENSE file
*/
class BeanConfigList extends BaseBean
{

    /**
     * @example :复杂配置
     */
    const TABLE = "config_list";
    public function getTableRule()
    {
        return ':复杂配置';
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
     * type
     * @example add_post,update_post,col_6,form_select:类型:1#logo,2#banner
     * @var int $type
     */
    public $type;
    public function get_type_rule()
    {
        return 'add_post,update_post,col_6,form_select:类型:1#logo,2#banner';
    }

    /**
     * url
     * @example add_post,update_post,col_6,form_text:外链
     * @var string $url
     */
    public $url;
    public function get_url_rule()
    {
        return 'add_post,update_post,col_6,form_text:外链';
    }

    /**
     * title
     * @example add_post,update_post,col_12,form_text:标题
     * @var string $title
     */
    public $title;
    public function get_title_rule()
    {
        return 'add_post,update_post,col_12,form_text:标题';
    }

    /**
     * file
     * @example add_post,update_post,col_6,form_img:文件
     * @var string $file
     */
    public $file;
    public function get_file_rule()
    {
        return 'add_post,update_post,col_6,form_img:文件';
    }

    /**
     * display_order
     * @example add_post,update_post,col_6,form_text:排序
     * @var int $display_order
     */
    public $display_order;
    public function get_display_order_rule()
    {
        return 'add_post,update_post,col_6,form_text:排序';
    }

    /**
     * content
     * @example add_post,update_post,col_12,form_textarea:内容
     * @var string $content
     */
    public $content;
    public function get_content_rule()
    {
        return 'add_post,update_post,col_12,form_textarea:内容';
    }

    /**
     * created_at
     * @example add_date_time:创建时间
     * @var string $created_at
     */
    public $created_at;
    public function get_created_at_rule()
    {
        return 'add_date_time:创建时间';
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
