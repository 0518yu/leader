<?php


namespace App\pithy;


class File
{
    private $date;
    public function __construct()
    {
        $this->date = date('Ymd');
    }

    /**
     * 默认小于2MB
     * @param string $key
     * @param float|int $size
     * @param null $err
     * @return array
     */
    public function uploadMulti(&$err = null, $key = 'file', $size = 2 * 1024 * 1024)
    {

        $public_root = ROOT . 'public/';
        // 判断目录
        if (!is_dir($public_root . 'upload/')) {
            mkdir($public_root . 'upload', 0777, true);
        }
        if (!is_dir($public_root . 'upload/' . $this->date)) {
            mkdir($public_root . 'upload/' . $this->date, 0777, true);
        }

        $resultList = [];

        foreach ($_FILES[$key]["size"] as $k => $v) {
            // 只判断大小符合标准即可
            if ($v >= $size) {
                $err = '文件过大';
                return [];
            }
            if ($_FILES[$key]["error"][$k] > 0) {
                $err = $_FILES[$key]["error"][$k];
                return [];
            }
        }

        foreach ($_FILES["file"]["name"] as $k => $v) {
            $result = 'upload/' . $this->date . '/' . time() . '_' . rand(1000, 9999) . $this->fileSuffix($v);
            $file = $public_root . $result;
            // 只判断大小符合标准即可
            move_uploaded_file($_FILES[$key]["tmp_name"][$k], $file);
            $resultList[] = '/' . $result;
        }
        return $resultList;
    }

    /**
     * 默认小于2MB
     * @param string $key
     * @param float|int $size
     * @param null $err
     * @return string
     */
    public function uploadOne(&$err = null, $key = 'file', $size = 2 * 1024 * 1024)
    {
        $public_root = ROOT . 'public/';
        // 判断目录
        if (!is_dir($public_root . 'upload/')) {
            mkdir($public_root . 'upload', 0777, true);
        }
        if (!is_dir($public_root . 'upload/' . $this->date)) {
            mkdir($public_root . 'upload/' . $this->date, 0777, true);
        }
        $result = 'upload/' . $this->date . '/' . time() . '_' . rand(1000, 9999) . $this->fileSuffix($_FILES["file"]["name"]);
        $file = $public_root . $result;
        // 只判断大小符合标准即可
        if ($_FILES[$key]["size"] < $size) {
            if ($_FILES[$key]["error"] > 0) {
                $err = $_FILES[$key]["error"];
                return '';
            } else {
                move_uploaded_file($_FILES[$key]["tmp_name"], $file);
            }
        } else {
            $err = '文件过大';
            return '';
        }
        return '/' . $result;
    }

    function fileSuffix($filename)
    {
        return strtolower(strrchr($filename, '.'));
    }
}