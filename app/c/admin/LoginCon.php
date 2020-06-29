<?php

namespace App\c\admin;

use App\c\mid\Check;
use App\m\BeanUsers;
use App\pithy\Session;
use App\s\Captcha;

/**
 * Class LoginCon
 * @package App\c\admin
 */
class LoginCon extends AdminCon
{
    use Check;
    const INDEX = '/admin/index';
    const LOGIN = '/admin/login';
    const OUT = '/admin/out';

    public function login()
    {
        if (is_post()) {
            // 检查图片验证码
            $captcha = Captcha::initCaptcha($_POST['captcha']);
            if (!check_pass($captcha, $_POST['__TOKEN__']))
                return $this->resp(['status' => 500, 'msg' => '验证码错误']);
            $account = $_POST['account'];
            $password = $_POST['password'];
            $user = BeanUsers::queryOne(['account' => $account, 'r_id' => [1, 2, 3]]);
            if ($user && $password && $password == $user->password) {
                Session::put('session_key', $user->id);
                return $this->resp(['status' => 200, 'url' => LoginCon::INDEX]);
            }
            return $this->resp(['status' => 500, 'msg' => '确认账号和密码']);
        }
        extract(['meta_title' => '登录']);
        return $this->html() && include TEMPLATE . "admin/index/login.php";
    }

    public function out()
    {
        Session::put('session_key', 0);
        return $this->redirect(LoginCon::LOGIN);
    }

    public function index()
    {
        extract([]);
        return $this->html() && include TEMPLATE . "admin/index/index.php";
    }
}