<?php

namespace App\c;

class Home
{
    public function index()
    {
        html() && include TEMPLATE . "index.php";
    }
}