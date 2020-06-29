<?php


namespace App\s;


use App\s\tpl\BaseElement;
use App\s\tpl\EleImg;
use App\s\tpl\EleImgList;
use App\s\tpl\EleRow;
use App\s\tpl\EleSelect;
use App\s\tpl\EleSummerNote;
use App\s\tpl\EleText;
use App\s\tpl\EleTextarea;

/**
 * 后台管理用户填的是什么就是什么
 * Class TplForm
 * @package App\s
 */
class TplForm
{
    protected $action, $title, $w;
    /**
     * @var array BaseElement
     */
    protected $elements = [];

    public function __construct($action, $title, $w = '12')
    {
        $this->title = $title;
        $this->action = $action;
        $this->w = $w;
    }

    /**
     * @param $type
     * @return BaseElement
     */
    protected function getTpl($type)
    {
        switch ($type) {
            case "link":
            case "select":
                return new EleSelect();
            case "text":
                return new EleText();
            case "textarea":
                return new EleTextarea();
            case "img":
                return new EleImg();
            case "imgs":
                return new EleImgList();
            case "editor":// 富文本
                return new EleSummerNote();
        }
        return new BaseElement();
    }

    public function addEle($type, $col, $column, $title, $default, $select)
    {
        $el = $this->getTpl($type);
        $el->w = $col;
        $el->column = $column;
        $el->title = $title;
        $el->default = $default;
        $el->select = $select;
        $this->elements[] = $el;
        $rowNum = 0;
        foreach ($this->elements as $el) {
            $rowNum += intval($el->column);
        }
        if (0 == $rowNum % 12) $this->elements[] = new EleRow();
    }

    function format()
    {
        /**
         * @var $element BaseElement
         */
        ?>
        <form role="form" method="post" id="diy_form" action="<?= $this->action ?>">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-<?= $this->w ?>">
                            <!-- SELECT2 EXAMPLE -->
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title"><?= $this->title ?></h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($this->elements as $element) $element->format(); ?>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="button" class="btn btn-info" onclick="save()">保存</button>
                                    <button type="button" class="btn btn-default float-right" onclick="back()">取消
                                    </button>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>
        </form>
        <!-- /.content -->
        <script>
            function save() {
                for (let i = 0; i < before_submit.length; i++) {
                    before_submit[i]();
                }
                document.getElementById('diy_form').submit();
            }

            function back() {
                window.history.back();
            }
        </script>
        <?php
    }
}