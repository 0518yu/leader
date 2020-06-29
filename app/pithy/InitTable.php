<?php


namespace App\pithy;


class InitTable
{
    function init()
    {
        $db = new BeanPDO();
        $sql = /** @lang text */
            <<<SQL
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'index_show,except_admin:id',
  `name` varchar(255) NOT NULL COMMENT 'index_show,add_post,update_post,form_text:姓名:',
  `password` varchar(255) NOT NULL COMMENT 'add_post,update_post,form_text:密码:',
  `account` varchar(255) NOT NULL COMMENT 'index_show,add_post,update_post,form_text:账号:',
  `r_id` int(11) NOT NULL DEFAULT '3' COMMENT 'add_post,update_post,form_select,filter_role:角色:1#管理员,2#店长,6#用户',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'add_post,update_post,form_select:状态:1#正常,9#封号',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'index_show,add_date_time:创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'add_date_time,update_date_time:修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT='用户表';
SQL;
        $db->exec($sql);

        $sql = /** @lang text */
            <<<SQL
CREATE TABLE `sys_menu` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(255) NOT NULL DEFAULT '0' COMMENT ':上级目录',
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT ':标题',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT ':url',
  `icon` varchar(255) NOT NULL DEFAULT '' COMMENT ':图标',
  `rids` varchar(255) NOT NULL DEFAULT '' COMMENT ':授权角色',
  `uids` varchar(255) NOT NULL DEFAULT '' COMMENT ':授权用户',
  `is_menu` int(11) NOT NULL DEFAULT '0' COMMENT ':是否是菜单: 1是 0 不是',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT ':状态:1是正常 0禁用',
  `display_order` int(10) NOT NULL DEFAULT '0' COMMENT ':排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT=':系统菜单';
SQL;
        $db->exec($sql);
        $db->exec(/** @lang text */
            "INSERT INTO `leader`.`users`(`id`, `name`, `password`, `account`, `r_id`, `status`, `created_at`, `updated_at`) VALUES (1, 'admin', 'admin', 'admin', 1, 1, '2020-06-27 15:03:20', '2020-06-27 15:03:23');"
        );

        $sql = /** @lang text */
            <<<SQL
CREATE TABLE `config` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT ':名称',
  `value` varchar(255) NOT NULL COMMENT 'form#text:值',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT '常量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT=':配置表';
SQL;
        $db->exec($sql);

        $sql = /** @lang text */
            <<<SQL
CREATE TABLE `config_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(10) NOT NULL DEFAULT '0' COMMENT 'add_post,update_post,col_6,form_select:类型:1#logo,2#banner',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT 'add_post,update_post,col_6,form_text:外链',
  `title` varchar(255) NOT NULL COMMENT 'add_post,update_post,col_12,form_text:标题',
  `file` varchar(255) NOT NULL COMMENT 'add_post,update_post,col_6,form_img:文件',
  `display_order` int(11) NOT NULL DEFAULT '0' COMMENT 'add_post,update_post,col_6,form_text:排序',
  `content` text NOT NULL COMMENT 'add_post,update_post,col_12,form_textarea:内容',
  `created_at` timestamp NULL DEFAULT NULL COMMENT 'add_date_time:创建时间',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'add_date_time,update_date_time:修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT=':复杂配置';
SQL;
        $db->exec($sql);
    }
}