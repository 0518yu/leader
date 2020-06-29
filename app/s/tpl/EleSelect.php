<?php


namespace App\s\tpl;


class EleSelect extends BaseElement
{
    function format()
    { ?>
        <div class="col-md-<?= $this->w ?>">
            <div class="form-group">
                <label for="id_<?= $this->column ?>"><?= $this->title ?></label>
                <select id="id_<?= $this->column ?>" class="form-control select2" style="width: 100%;"
                        name="<?= $this->column ?>">
                    <?php
                    foreach ($this->select as $k => $v) { ?>
                        <option <?= $this->default == $k ? 'selected' : '' ?> value="<?= $k ?>"><?= $v ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <?php
    }
}