<?php

namespace App\c\admin;

use App\pithy\BaseBean;
use App\pithy\BaseCon;
use App\pithy\BeanPDO;
use App\pithy\Rule;
use App\s\TplForm;


/**
 * Class AdminCon
 * @package App\c\admin
 */
class AdminCon extends BaseCon
{
    /**
     * @const TABLE
     * @var BaseBean
     */
    protected $class;
    const INDEX = '';
    const ADD = '';
    const UPDATE = '';
    const DEL = '';

    public function __construct($is_api = false)
    {
        parent::__construct($is_api);
    }

    // 初始化多个字段的下拉
    protected function select_config()
    {
        return [];
    }

    // 自定义首页查询
    protected function index_search($where)
    {
        if (isset($_GET['search_title'])) $where['id'] = $_GET['search_title'];
        return [$where, []];
    }


    protected function index_order()
    {
        if (!isset($_GET['order_by']))
            return 'order by id desc';
        if (0 == intval($_GET['order_by']))
            return 'order by id desc';
        return 'order by id asc';
    }

    public function index_common($where = [])
    {
        list($where, $opt) = $this->index_search($where);
        $order = $this->index_order();
        $rule = new Rule($this->class);
        $rule->rule('index', $show_config, $where);

        $m = new BeanPDO($this->class);
        $pageSize = 10;

        list($total, $l) = $m->r($where, max(0, $_GET['page']), $pageSize, $order, $opt);
        extract([
            'c_page' => $_GET['page'],
            't_page' => ceil($total / $pageSize),
            'list' => $l,
            'url_index' => $this::INDEX,
            'url_add' => $this::ADD,
            'url_update' => $this::UPDATE,
            'url_del' => $this::DEL,
            'show_config' => $show_config,// 列表展示字段
        ]);
        return $this->html() && include TEMPLATE . "admin/tpl/auto_index.php";
    }

    public function add_common($page_name = '新增', $page_name_list = [], $w = '6', $other_forms = [])
    {
        $config = $this->select_config();
        $rule = new Rule($this->class);
        if (is_post()) {
            $db = new BeanPDO($this->class);
            $rule->rule('add', $data, $where);
            $db->c($data);
            return $this->redirect($this::INDEX);
        }
        $form = new TplForm($this::ADD, $page_name, $w);
        foreach ($rule->form as $k => $v) {
            foreach ($v as $index => $v1) {
                $col = isset($rule->col[$k][$index]) ? $rule->col[$k][$index] : '12';
                $form->addEle(
                    $v1, $col, $k, $rule->form_name[$k], '', $config[$k]
                );
            }
        }
        extract([
            'page_name' => $page_name, 'page_name_list' => $page_name_list, 'form' => $form,
            'other_forms' => $other_forms,
        ]);
        return $this->html() && include TEMPLATE . "admin/tpl/auto_page.php";
    }

    public function update_common($page_name = '修改', $page_name_list = [], $w = '6')
    {
        $config = $this->select_config();
        $db = new BeanPDO($this->class);
        /**
         * @var $b BaseBean
         */
        $id = $_GET['id'];
        $b = $db->selectOne(['id' => $id]);
        $rule = new Rule($this->class);
        if (is_post()) {
            $rule->rule('update', $data, $where);
            $db->u($data, ['id' => $id]);
            return $this->redirect($this::INDEX);
        }
        $form = new TplForm($this::UPDATE . '?id=' . $id, $page_name, $w);

        foreach ($rule->form as $k => $v) {
            foreach ($v as $index => $v1) {
                $col = isset($rule->col[$k][$index]) ? $rule->col[$k][$index] : '12';
                $form->addEle(
                    $v1, $col, $k, $rule->form_name[$k], $b->{$k}, $config[$k]
                );
            }
        }
        extract(['page_name' => $page_name, 'page_name_list' => $page_name_list, 'form' => $form]);

        return $this->html() && include TEMPLATE . "admin/tpl/auto_page.php";
    }

    /**
     * $id int|array
     * @return bool
     */
    public function del()
    {
        $id = $_POST['id'];
        $db = new BeanPDO($this->class);
        $db->d(['id' => $id]);
        return $this->resp(['status' => 200, 'msg' => '删除成功']);
    }

    /**
     * 直接输出html页面
     * @param $_
     * @return mixed
     */
    public function html()
    {
        header("Content-Type: text/html; charset=utf-8");
        require TEMPLATE . 'admin/tpl/layout.php';
        require TEMPLATE . 'admin/tpl/page.php';
        return true;
    }
}