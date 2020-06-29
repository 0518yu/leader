<?php


namespace App\pithy;


class BaseCon
{
    protected $is_api = false;


    public function __construct($is_api = false)
    {
        $this->is_api = $is_api;
    }

    /**
     * 返回json
     * @param $arr
     * @return bool
     */
    public function resp($arr)
    {
        header("Content-type: application/json");
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        return true;
    }

    /**
     * 直接输出html页面
     * @return mixed
     */
    public function html()
    {
        header("Content-Type: text/html; charset=utf-8");
        return true;
    }

    /**
     * @param $url
     * @param bool $isDebug
     * @return bool
     */
    public function redirect($url, $isDebug = false)
    {
        if ($isDebug) exit("<a href=\"{$url}\">{$url}</a>");
        echo "<script type=\"text/javascript\">window.location.href=\"{$url}\"</script>";
        return true;
    }

}