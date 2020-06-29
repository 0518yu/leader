<?php


namespace App\pithy;


class Orm
{
    /**
     * 创建 mysql 结构模型
     * @param string $namespace
     * @param string $beanPath
     */
    public function init($namespace = "App\m", $beanPath = ROOT . '/app/m/')
    {
        $packageName = $namespace;
        $db = new BeanPDO();
        $result = $db->pdo->query("show full tables where Table_Type != 'VIEW'")->fetchAll();
        foreach ($result as $row) {
            $tableName = current($row);
            $className = "Bean" . underscoreToCamelCase($tableName, true);

            echo 'format table :' . $tableName, PHP_EOL;
            $template = @file_get_contents(__DIR__ . '/Beans.tpl');
            $processedContent = '';

            // init head
            $processedContent .= $this->setHead($db, $template, $namespace, $tableName, $packageName, $className);

            // init property
            $sqlFields = "SHOW FULL COLUMNS FROM $tableName";
            $fields = $db->pdo->query($sqlFields)->fetchAll();
            foreach ($fields as $item) {
                $processedContent .= $this->setAttr($template, $item);
            }

            // init foot
            $processedContent .= $this->setBlock($template, "PhpFooter");

            $classFileName = $className . ".php";
            $saveFile = $beanPath . $classFileName;

            // save php file
            @file_put_contents($saveFile, $processedContent);
        }
    }

    /**
     * 格式化 column 数据
     * @param $template
     * @param $object
     * @return mixed
     */
    private function setAttr($template, $object)
    {
        $b = $this->setBlock($template, "SingleAttributes");

        $this->setVar($b, "TableFieldName", $object['Field']);
        $setType = $object['Type'];
        if ($setType == "date" || $setType == "time") $setType = "string|" . $object['Type'];
        $this->setVar($b, "TableFieldTypeAndLenght", $setType);
        $this->setVar($b, "TableFieldNullable", $object['Null']);
        $this->setVar($b, "TableFieldIndex", $object['Key']);
        $this->setVar($b, "TableFieldDefault", $object['Default']);
        $this->setVar($b, "TableFieldExtra", $object['Extra']);
        $content = empty($object['Comment']) ? "" : $object['Comment'];
        $this->setVar($b, "Comment", $content);
        $this->setVar($b, "Rule", $content);
        $this->setVar($b, "ClassAttributeName", $object['Field']);
        $this->setVar($b, "ClassAttributeType", $this->getTypeForPHPDoc($setType));
        return $b;
    }

    /**
     * 格式化头部信息
     * @param $db
     * @param $template
     * @param $namespace
     * @param $tableName
     * @param $packageName
     * @param $className
     * @return mixed
     */
    private function setHead($db, $template, $namespace, $tableName, $packageName, $className)
    {
        // 设置
        $b = $this->setBlock($template, "PhpHeader");
        $this->setVar($b, "NameSpace", $namespace);

        $this->setVar($b, "ClassName", $className);
        $this->setVar($b, "TableName", $tableName);

        $row = $db->pdo->query(/** @lang text */ "SELECT TABLE_COMMENT FROM information_schema.tables WHERE table_schema = DATABASE() AND TABLE_NAME='$tableName'")->fetch();
        $content = current($row);
        $this->setVar($b, "TableComment", $content);
        $this->setVar($b, "ClassFileName", $className . ".php");
        $this->setVar($b, "ClassParent", '');

        $this->setVar($b, "ClassPackageName", $packageName);
        $this->setVar($b, "AuthorName", 'frame-php-free');
        $this->setVar($b, "AuthorEmail", '');
        $this->setVar($b, "ClassVersion", '');

        $this->setVar($b, "Rule", $content);
        return $b;
    }


    /**
     * 替换变量占位
     * @param $block
     * @param $var
     * @param string $value
     */
    private function setVar(&$block, $var, $value = "")
    {
        $block = str_replace("{" . $var . "}", $value, $block);
    }

    /**
     * 剪切模板模块
     * @param $template
     * @param $block
     * @param bool $isContent
     * @return mixed
     */
    private function setBlock($template, $block, $isContent = false)
    {
        if (!$isContent) {
            $regex = "/\<\!-- BEGIN $block --\>(.*?)\<\!-- END $block --\>/s";
            preg_match_all($regex, $template, $result);
            @$block = $result[1][0];
            return $block;
        } else {
            return $block;
        }
    }

    /**
     * @param $type
     * @return mixed|string
     */
    private function getTypeForPHPDoc($type)
    {
        foreach ([
                     '/int/' => 'int',
                     '/year/' => 'int',
                     '/integer/' => "int",
                     '/tynyint/' => "int",
                     '/smallint/' => "int",
                     '/mediumint/' => "int",
                     '/bigint/' => "int",
                     '/varchar/' => "string",
                     '/char/' => "string",
                     '/text/' => "string",
                     '/tyntext/' => "string",
                     '/mediumtext/' => "string",
                     '/longtext/' => "string",
                     '/enum/' => "string",
                     '/set/' => "string",
                     '/date/' => "string",
                     '/time/' => "string",
                     '/datetime/' => "string",
                     '/decimal/' => "float",
                     '/float/' => "float",
                     '/double/' => "float",
                     '/real/' => "float",
                     '/fixed/' => "float",
                     '/numeric/' => "int",
                 ] as $k => $v) {
            if (preg_match($k, $type)) return $v;
        }
        return 'null';
    }
}