<?php


namespace App\s\tpl;

use App\c\admin\SysCon;

class EleSummerNote extends BaseElement
{
    function format()
    { ?>
        <!-- /.row -->
        <input type="hidden" name="<?= $this->column ?>" id="id_<?= $this->column ?>">
        <label for="old_<?= $this->column ?>"></label>
        <textarea style="display: none;" id="old_<?= $this->column ?>"><?= $this->default ?></textarea>
        <div class="col-md-<?= $this->w ?>">
            <label for="editor_<?= $this->column ?>"></label>
            <textarea id="editor_<?= $this->column ?>" class="textarea" placeholder="Place some text here"
                      style="width: 100%; height: 700px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        </div>
        <script>
            before_submit.push(parse_<?= $this->column ?>_editor);
            init_call.push(init_<?= $this->column ?>_editor);

            function init_<?= $this->column ?>_editor() {
                // Summernote
                $('#editor_<?= $this->column ?>').summernote({
                    placeholder: '详情 ...',
                    tabsize: 2,
                    height: 500,
                    minHeight: 500,             // set minimum height of editor
                    maxHeight: 800,             // set maximum height of editor
                    callbacks: {
                        onImageUpload: function (files) {
                            // 一个一个上传
                            for (var i = 0; i < files.length; i++) {
                                var fd = new FormData();
                                fd.append("file", files[i]);
                                $.ajax({
                                    url: "<?=SysCon::UPLOAD?>",
                                    type: "POST",
                                    processData: false,
                                    contentType: false,
                                    data: fd,
                                    dataType: 'json',
                                    success: function (d) {
                                        if (200 === d.status) {
                                            var imgNode = new Image();
                                            imgNode.src = d.path;
                                            // upload image to server and create imgNode...
                                            $('#editor_<?= $this->column ?>').summernote('insertNode', imgNode);
                                        } else {
                                            alert(d.msg);
                                        }
                                    }
                                });
                            }
                            console.log(files);
                        }
                    }
                });
                $('#editor_<?= $this->column ?>').summernote('code', $('#old_<?= $this->column ?>').val());
            }

            function parse_<?= $this->column ?>_editor() {
                var markupStr = $('#editor_<?= $this->column ?>').summernote('code');
                $('#id_<?= $this->column ?>').val(markupStr);
                return true;
            }

        </script>
        <?php
    }
}