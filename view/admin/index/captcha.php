<?php
/**
 * @var $hash string
 * @var $imgStr string
 * @var $code string
 */
?>
<input type="hidden" name="__TOKEN__" value="<?= $hash ?>">
<label for="captcha_input"></label>
<div class="col-8"><input id="captcha_input" type="text" class="form-control" value="<?=substr($code,0,3)?>" name="captcha" placeholder="验证码"></div>
<div class="col-4"><img onclick="load_captcha()" width="100%" src="<?= $imgStr ?>" alt=""></div>