<?php


namespace App\pithy;


use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * Class BaseRule
 * @package App\pithy
 */
class BaseRule
{
    // 列表规则
    public $index = [];
    // 新增规则
    protected $add = [];
    // 修改规则
    protected $update = [];
    // 删除规则
    protected $del = [];

    // select过滤规则
    public $select = [];
    // form 表单设置
    public $form = [];
    public $form_name = [];
    public $col = [];

    /**
     * html 防xss
     * @var HTMLPurifier
     */
    public $pur = null;

    /**
     * YuRule constructor.
     * @param $class
     * @param null $m
     */
    public function __construct($class, $m = null)
    {
        if (null === $m) $m = new $class();
        $this->initColumnRule($m);
    }

    /**
     * @param $m BaseBean
     */
    private function initColumnRule($m)
    {
        foreach ($m as $column => $v) {
            $method = "get_{$column}_rule";
            $l = explode(':', $m->$method());
            foreach (isset($l[0]) ? explode(',', $l[0]) : [] as $fun) {
                $fun && $this->{$fun}($column);
            }
            $this->form_name[$column] = isset($l[1]) ? $l[1] : '';
        }
    }

    // 列表相关规则
    public function rule($property, &$data, &$where)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $this->pur = $purifier;

        foreach ($this->$property ?: [] as $k => $funList) {
            foreach ($funList ?: [] as $fun) {
                $fun($data, $where);
            }
        }
    }
    // ********** 基本规则 **********
    // 字段新增 从post取数据
    protected function add_post($column)
    {
        $t = $this;
        $this->add[$column][] = function (&$data, &$where) use ($column, $t) {
            $clean_html = $t->pur->purify($_POST[$column] ?: '');
            $data[$column] = $clean_html;
        };
    }

    // 字段修改 从post取数据
    protected function update_post($column)
    {
        $t = $this;
        $this->update[$column][] = function (&$data, &$where) use ($column, $t) {
            $clean_html = $t->pur->purify($_POST[$column] ?: '');
            $data[$column] = $clean_html;
        };
    }

    // form 表单宽度 12
    protected function col_12($column)
    {
        $this->col[$column][] = '12';
    }

    // form 表单宽度 6
    protected function col_6($column)
    {
        $this->col[$column][] = '6';
    }

    // form 表单字段input类型
    protected function form_link($column)
    {
        $this->form[$column][] = 'link';
    }

    // form 表单字段input类型
    protected function form_editor($column)
    {
        $this->form[$column][] = 'editor';
    }

    // form 表单字段input类型
    protected function form_text($column)
    {
        $this->form[$column][] = 'text';
    }

    // form 表单字段input类型
    protected function form_textarea($column)
    {
        $this->form[$column][] = 'textarea';
    }

    // form 表单字段select类型
    protected function form_select($column)
    {
        $this->form[$column][] = 'select';
    }

    // form 表单字段select类型
    protected function form_img($column)
    {
        $this->form[$column][] = 'img';
    }

    // form 表单字段select类型
    protected function form_imgs($column)
    {
        $this->form[$column][] = 'imgs';
    }


    // 字段新增 设置时间
    protected function add_date_time($column)
    {
        $this->add[$column][] = function (&$data, &$where) use ($column) {
            $data[$column] = date('Y-m-d H:i:s');
        };
    }

    // 字段修改 设置时间
    protected function update_date_time($column)
    {
        $this->update[$column][] = function (&$data, &$where) use ($column) {
            $data[$column] = date('Y-m-d H:i:s');
        };
    }

    protected function index_show($column)
    {
        $this->index[$column][] = function (&$data, &$where) use ($column) {
            $data[$column] = $this->form_name[$column];
        };
    }
}