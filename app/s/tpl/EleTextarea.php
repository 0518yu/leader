<?php


namespace App\s\tpl;


class EleTextarea extends BaseElement
{
    function format()
    { ?>
        <div class="col-md-<?= $this->w ?>">
            <div class="form-group">
                <label for="id_<?= $this->column ?>"><?= $this->title ?></label>
                <textarea id="id_<?= $this->column ?>" class="form-control" rows="3" name="<?= $this->column ?>"
                          placeholder="输入 ..."><?= _($this->default) ?></textarea>
            </div>
        </div>
        <?php
    }
}