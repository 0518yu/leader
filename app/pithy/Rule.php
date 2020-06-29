<?php


namespace App\pithy;


use App\s\UserServer;

/**
 * Class Rule
 * @package App\pithy
 */
class Rule extends BaseRule
{
    // 查询,修改和删除都剔除admin账号
    // 禁止动用admin账号
    public function except_admin($column)
    {
        // 查找非管理员的
        $this->index[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = ['<>', 1];
        };
        // 修改非管理员的
        $this->update[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = ['<>', 1];
        };
        // 删除非管理员的
        $this->del[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = ['<>', 1];
        };
    }

    // 所有操作需要过滤用户
    public function owner($column)
    {
        // 查询过滤该用户
        $this->index[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = UserServer::loginInfo()->id;
        };
        // 新增默认填写该用户
        $this->add[$column][] = function (&$data, &$where) use ($column) {
            $data[$column] = UserServer::loginInfo()->id;
        };
        // 修改该用户的
        $this->update[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = UserServer::loginInfo()->id;
        };
        // 删除该用户的
        $this->del[$column][] = function (&$data, &$where) use ($column) {
            $where[$column] = UserServer::loginInfo()->id;
        };
    }
}