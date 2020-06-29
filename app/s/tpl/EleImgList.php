<?php


namespace App\s\tpl;


class EleImgList extends BaseElement
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
                        <input type="file"
                               onchange="diy_upload_file_multi(this,after_upload_multi_<?= $this->column ?>)"
                               class="custom-file-input"
                               id="show_id_<?= $this->column ?>" multiple="multiple">
                        <label class="custom-file-label" for="show_id_<?= $this->column ?>">选择文件</label>
                    </div>
                </div>
            </div>
            <div class="form-group" id="show_img_<?= $this->column ?>">
                <label for="exampleInputFile">预览</label>
                <div class="input-group" id="input_group_<?= $this->column ?>">
                    <?php foreach (explode(',', _($this->default)) as $index => $src): ?>
                        <img id="img_<?= $this->column ?>_<?= $index ?>" style="width:100%" src="<?= $src ?>" alt="">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- /.col -->
        <script>
            function after_upload_multi_<?=$this->column?>(d) {
                console.log(d);
                let input_group = $('#input_group_<?= $this->column ?>');
                if (200 === d.status) {
                    $('#show_img_<?=$this->column?>').show();
                    input_group.html('');
                    let src_list = d.path;
                    for (let i = 0; i < src_list.length; i++)
                        input_group.append('<img id="img_<?= $this->column ?>_' + i + '" style="width:100%" src="' + src_list[i] + '" alt="">');

                    $('#id_<?=$this->column?>').val(d.path.join(','));
                }

            }
        </script>
        <?php
    }
}