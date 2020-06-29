<?php


namespace App\pithy;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

class BeanPDO
{
    public $pdo;
    protected $dsn;

    /**
     * @var BaseBean
     */
    private $class;

    /**
     * BeanPDO constructor.
     * @param null $class
     */
    public function __construct($class = null)
    {
        $this->class = $class;
        $attr = [
            'dbname' => env('db_name'),
            'port' => env('db_port', 3306),
            'host' => env('db_server'),
            'charset' => 'utf8',
        ];
        $stack = [];
        foreach ($attr as $key => $value) {
            $stack[] = is_int($key) ? $value : $key . '=' . $value;
        }
        $dsn = 'mysql:' . implode(';', $stack);

        $this->dsn = $dsn;
        try {
            $this->pdo = new PDO(
                $dsn,
                env('db_username', null),
                env('db_password', null),
                [
                    // 默认的 fetch 方式
                    PDO::ATTR_DEFAULT_FETCH_MODE => null === $this->class ? PDO::FETCH_NAMED : PDO::FETCH_CLASS,
                    // 链接之后执行的命令
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET SQL_MODE=ANSI_QUOTES',
                    // 异常处理方式
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_EMULATE_PREPARES => false// 出现int转化为string limit 语句
                ]
            );
//            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    //  ":" . implode(", :", array_keys($data))
    //  $statement->execute($data);// 命名占位符 不写冒号也行
    // Create  通用插入操作
    public function c($data)
    {
        $v = array_values($data);
        $sql = sprintf(
        /** @lang text */ "INSERT INTO %s (%s) values (%s)",
            $this->tableQuote($this->class::TABLE),
            implode(", ", array_keys($data)),

            trim(str_repeat("?,", sizeof($v)), ',')
        );
        $statement = $this->pdo->prepare($sql);
        $statement->execute($v);// ?占位符
        $statement = null;//释放查询结果
        $lastId = $this->pdo->lastInsertId();
        if ($lastId != "0" && $lastId != "") return $lastId;
        return null;
    }
    // update 修改数据
    public function u($data, $where = [], $opt = [])
    {
        list($_1, $_2) = $this->parseWhere($where, $opt);
        $sql = sprintf(
        /** @lang text */ "UPDATE %s SET %s %s",
            $this->tableQuote($this->class::TABLE),
            implode(" = ? , ", array_keys($data)) . ' = ?',
            $_1
        );
        $this->exec($sql, array_merge(array_values($data), array_values($_2)), $num);

        return $num;
    }

    // Retrieve
    public function r($where, $page, $pageSize = 10, $order = 'order by id desc', $opt = [])
    {
        $list = $this->selectPage($where, $order, $page, $pageSize, $opt);
        $total = $this->selectPageCount($where, $opt);
        return [$total, $list];
    }

    // Delete
    public function d($where, $opt = [])
    {
        list($_1, $_2) = $this->parseWhere($where, $opt);
        $sql = sprintf(
        /** @lang text */ "DELETE FROM  %s %s",
            $this->tableQuote($this->class::TABLE),
            $_1
        );
        $this->exec($sql, array_values($_2), $num);
        return $num;
    }

    // 原生sql 批量执行
    public function execMulti($sql, $maps)
    {
        //准备sql模板
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) return $this->pdo->errorInfo();
        foreach ($maps as $map) $stmt->execute($map);
        $stmt = null;//释放查询结果
        return true;
    }

    // 原生sql 执行一条
    public function exec($sql, $map = [], &$num = 0)
    {
        //准备sql模板
        $stmt = $this->pdo->prepare($sql);
        if (!$stmt) return $this->pdo->errorInfo();
        $stmt->execute($map);
        $num = $stmt->rowCount();
        $info = $stmt->errorInfo();
        $stmt = null;//释放查询结果
        return $info;
    }

    // 原生sql 查询获取array 列表
    public function queryArrList($sql, $map_pre)
    {
        //准备sql模板
        $stmt = $this->query_stmt($sql, $map_pre);
        $result = $stmt->fetchAll(PDO::FETCH_NAMED);
        $stmt = null;//释放查询结果
        return $result ?: [];
    }

    // 原生sql 查询获取 预设对象 列表
    public function queryObjList($sql, $map_pre)
    {
        //准备sql模板
        $stmt = $this->query_stmt($sql, $map_pre);
        //推荐这种方式来获取查询结果
        //$result = [];
        //while ($row = $stmt->fetchObject($this->class)) $result[] = $row;
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $this->class);

        //释放查询结果
        $stmt = null;
        return $result ?: [];
    }


    public function selectOne($where, $opt = [])
    {
        list($_1, $_2) = $this->parseWhere($where, $opt);
        $sql = sprintf(
        /** @lang text */ "SELECT * from %s %s limit 1",
            $this->tableQuote($this->class::TABLE),
            $_1
        );
        //准备sql模板
        $stmt = $this->query_stmt($sql, $_2);
        $result = $stmt->fetchObject($this->class);
        $stmt = null;//释放查询结果
        return $result;
    }

    /**
     * @param $where
     * @param string $order
     * @param int $page
     * @param int $pageSize
     * @param $opt array
     * @return array $this->class
     */
    public function selectPage($where, $order = '', $page = 0, $pageSize = 10, $opt = [])
    {
        list($_1, $_2) = $this->parseWhere($where, $opt);
        $sql = sprintf(
        /** @lang text */ "SELECT * from %s %s %s limit ?,?",
            $this->tableQuote($this->class::TABLE),
            $_1,
            $order
        );
        $_2[] = $page * $pageSize;
        $_2[] = $pageSize;
        //准备sql模板
        $stmt = $this->query_stmt($sql, $_2);
        $result = $stmt->fetchAll(PDO::FETCH_CLASS, $this->class);
        $stmt = null;//释放查询结果
        return $result;
    }

    public function selectPageCount($where, $opt = [])
    {
        list($_1, $_2) = $this->parseWhere($where, $opt);
        // 统计
        $countSql = sprintf(
        /** @lang text */ "select count(1) as total from %s %s",
            $this->tableQuote($this->class::TABLE),
            $_1
        );
        //准备sql模板
        $stmt = $this->query_stmt($countSql, $_2);
        $result = $stmt->fetchColumn();
        $stmt = null;//释放查询结果
        return $result;
    }

    /**
     * 检查表名
     * @param $table
     * @return string
     */
    private function tableQuote($table)
    {
        return '`' . $table . '`';
    }

    // key_opt 不要使用页面传入的
    private function parseWhere($where, $key_opt = [])
    {
        if (!$where) return ['', []];
        $_1 = $_2 = [];
        foreach ($where as $k => $v) {
            // in 语句
            if (is_array($v)) {
                if (0 == sizeof($v)) continue;
                // in
                $_1[] = sprintf(" %s in (%s)", $k, trim(str_repeat("?,", sizeof($v)), ','));
                $_2 = array_merge($_2, array_values($v));
                continue;
            }
            $opt = isset($key_opt[$k]) ? $key_opt[$k] : '=';
            // 相等
            $_1[] = "{$k} {$opt} ?";
            $_2[] = $v;
        }
        return ['where ' . implode(' and ', $_1), $_2];
    }

    /**
     * 内部执行方法
     * @param $sql
     * @param $map_pre
     * @return PDOStatement
     */
    private function query_stmt($sql, $map_pre)
    {
        try {
            $stmt = $this->pdo->prepare($sql);
            if (!$stmt) throw new Exception($this->pdo->errorInfo());
            $arr = [];
            $i = 0;
            foreach ($map_pre ?: [] as $key => $item) {
                $i++;
                $arr[$i] = $item;
                $stmt->bindParam($i, $arr[$i]);
            }
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return null;
    }
}

