<?php

namespace App\c\admin;


use App\c\mid\Check;
use App\pithy\File;
use App\s\Captcha;

/**
 * Class SysCon
 * @package App\c\admin
 */
class SysCon extends AdminCon
{
    use Check;
    const UPLOAD = '/admin/sys/upload';
    const CAPTCHA = "/captcha";

    public function captcha()
    {
        // 生成 code 和 图片
        list($code, $imgStr) = Captcha::getCodeImgStr();
        $imgStr = "data:image/png;base64," . base64_encode($imgStr);
        $captcha = Captcha::initCaptcha($code);
        $hash = get_pass($captcha, 6);// 验证码相关的 6速度够快
        extract(['hash' => $hash, 'imgStr' => $imgStr, 'code' => $code]);
        return include(TEMPLATE . "admin/index/captcha.php");// 直接
    }

    public function do_upload()
    {
        $sys = new File();
        if (is_array($_FILES['file']['name'])) {
            $list = $sys->uploadMulti($err);
            if ($err) return $this->resp(['status' => 500, 'path' => '', 'msg' => $err]);
            return $this->resp(['status' => 200, 'path' => $list]);
        }
        $file = $sys->uploadOne($err);
        // 文件过大
        if ($err) return $this->resp(['status' => 500, 'path' => '', 'msg' => $err]);
        return $this->resp(['status' => 200, 'path' => $file]);
    }
}