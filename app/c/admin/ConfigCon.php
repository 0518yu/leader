<?php

namespace App\c\admin;

use App\c\mid\Check;
use App\m\BeanConfig;
use App\m\BeanConfigList;
use App\pithy\BeanPDO;
use App\s\SingleConfigServer;
use HTMLPurifier;
use HTMLPurifier_Config;

class ConfigCon extends AdminCon
{
    use Check;
    protected $class = BeanConfigList::class;
    CONST MENU = "/admin/config/menu";
    const SINGLE_INDEX = '/admin/config_single/index';
    const SINGLE_SAVE = '/admin/config_single/save';

    const INDEX = '/admin/config/index';
    const ADD = '/admin/config/add';
    const UPDATE = '/admin/config/update';
    const DEL = '/admin/config/del';

    public function single_config()
    {
        extract(['list' => SingleConfigServer::getList()]);
        return $this->html() && include(TEMPLATE . "admin/config/single_index.php");
    }

    public function single_config_update()
    {
        // 清理html标签
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $db = new BeanPDO(BeanConfig::class);
        foreach ($_POST['id'] as $k => $v)
            $db->u(['value' => $purifier->purify($_POST['value'][$k]?:'')], ['id' => $v]);
        $this->redirect(self::SINGLE_INDEX);
    }

    public function index()
    {
        $page = max(0, $_GET['page']);
        $page_size = 20;
        $db = new BeanPDO(BeanConfigList::class);
        $list = $db->selectPage([], '', $page, $page_size);
        $total = $db->selectPageCount([]);
        $config = (new BeanConfigList())->config('type');

        extract(['c_page' => $_GET['page'], 't_page' => ceil($total / $page_size), 'list' => $list, 'config' => $config]);
        return $this->html() && include(TEMPLATE . "admin/config/index.php");
    }

    public function add()
    {
        return $this->add_common('新增', ['系统配置', '复杂配置']);
    }

    public function update()
    {
        return parent::update_common('修改', ['系统配置', '复杂配置']);
    }

    protected function select_config()
    {
        $config = (new BeanConfigList())->config('type');
        return ['type' => $config];
    }
}