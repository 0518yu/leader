<?php


namespace App\s\tpl;


class EleText extends BaseElement
{
    function format()
    { ?>
        <div class="col-md-<?= $this->w ?>">
            <div class="form-group">
                <label for="id_<?= $this->column ?>"><?= $this->title ?></label>
                <input type="text" autocomplete="off" class="form-control" value="<?= _($this->default) ?>" name="<?= $this->column ?>"
                       id="id_<?= $this->column ?>">
            </div>
        </div>
        <?php
    }
}