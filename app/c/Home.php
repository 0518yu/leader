<?php

namespace App\c;


use App\pithy\BaseCon;

/**
 * Class Home
 * @package App\c
 */
class Home extends BaseCon
{
    public function index()
    {
        $this->html() && include TEMPLATE . "index.php";
    }
}