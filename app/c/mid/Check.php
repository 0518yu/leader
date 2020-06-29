<?php


namespace App\c\mid;


use App\c\admin\LoginCon;
use App\m\BeanSysMenu;
use App\m\BeanUsers;
use App\pithy\Session;
use App\s\UserServer;

/**
 * 检查登录，校验授权
 * Trait Check
 * @package App\s
 */
trait Check
{
    private function err_response($msg)
    {
        !$this->is_api && $this->redirect(LoginCon::LOGIN);;
        $this->is_api && $this->resp(['status' => 401, 'msg' => $msg]);
        return false;
    }

    /**
     * @return bool
     */
    public function __invoke()
    {

        // 检查登录
        if (!self::is_login()) return $this->err_response('请登录');

        // 检查用户状态
        $user = self::getUser();
        if (1 != $user->status) return $this->err_response('用户状态异常');

        /**
         * @var $url BeanSysMenu
         */
        $url = BeanSysMenu::queryOne(['url' => URI]);
        // 授权处理
        if (!$url) return $this->err_response('请求异常');
        // 检查接口授权角色
        if (false !== strpos($url->rids, '' . $user->r_id)) return true;
        // 检查接口授权用户
        if (false !== strpos($url->uids, '' . $user->id)) return true;
        return $this->err_response('未授权');
    }

    /**
     * @return BeanUsers
     */
    protected function getUser()
    {

        $user = UserServer::loginInfo();
        return $user;
    }

    /**
     * 是否登陆
     * @return bool
     */
    private function is_login()
    {
        $uid = Session::get('session_key');
        if ($uid) return true;
        return false;
    }

}