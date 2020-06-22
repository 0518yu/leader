<?php

use App\c\Home;

return [
    '/' => function () {
        (new Home())->index();
    }, '/debug' => function () {
        html() && include TEMPLATE . 'index.php';
    }
];