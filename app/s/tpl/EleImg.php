<?php


namespace App\s\tpl;


class EleImg extends BaseElement
{
    function format()
    { ?>
        <div class="col-md-<?= $this->w ?>">
            <div class="form-group">
                <label for="exampleInputFile"><?= $this->title ?></label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="hidden" name="<?= $this->column ?>" id="id_<?= $this->column ?>"
                               value="<?= _($this->default) ?>">
                        <input type="file" onchange="diy_upload_file(this,after_upload_<?= $this->column ?>)"
                               class="custom-file-input"
                               id="show_id_<?= $this->column ?>">
                        <label class="custom-file-label" for="show_id_<?= $this->column ?>">选择文件</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="show_img_<?= $this->column ?>">
                <label for="exampleInputFile">预览</label>
                <div class="input-group">
                    <img id="img_<?= $this->column ?>" style="" src="<?= _($this->default) ?>" alt="">
                </div>
            </div>
        </div>
        <!-- /.col -->
        <script>
            function after_upload_<?=$this->column?>(d) {
                if (200 === d.status) {
                    $('#show_img_<?=$this->column?>').show();
                    $('#img_<?=$this->column?>').attr('src', d.path);
                    $('#id_<?=$this->column?>').val(d.path);
                } else {
                    alert(d.msg);
                }
                console.log(d);
            }
        </script>
        <?php
    }
}