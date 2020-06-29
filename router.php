<?php

use App\c\admin\ConfigCon;
use App\c\admin\LoginCon;
use App\c\admin\SysCon;
use App\c\Home;

return [
    // ---------- 游客 ----------
    '/' => function () {
        (new Home())->index();
    }, '/xss' => function () {

    },
    // ---------- 系统相关 ----------
    SysCon::CAPTCHA => function () {
        (new SysCon())->captcha();
    }, SysCon::UPLOAD => function () {
        ($s = new SysCon()) && $s() && $s->do_upload();
    },
    // ---------- 登录模块 ----------
    LoginCon::LOGIN => function () {
        ($s = new LoginCon(is_post())) && $s->login();
    }, LoginCon::OUT => function () {
        ($s = new LoginCon()) && $s->out();
    }, LoginCon::INDEX => function () {
        ($s = new LoginCon()) && $s() && $s->index();
    },

    // ---------- 配置模块 ----------
    ConfigCon::MENU => function () {
    }, ConfigCon::SINGLE_INDEX => function () {
        ($s = new ConfigCon()) && $s() && $s->single_config();
    }, ConfigCon::SINGLE_SAVE => function () {
        ($s = new ConfigCon()) && $s() && $s->single_config_update();
    }, ConfigCon::INDEX => function () {
        ($s = new ConfigCon()) && $s() && $s->index();
    }, ConfigCon::ADD => function () {
        ($s = new ConfigCon()) && $s() && $s->add();
    }, ConfigCon::UPDATE => function () {
        ($s = new ConfigCon()) && $s() && $s->update();
    }, ConfigCon::DEL => function () {
        ($s = new ConfigCon()) && $s() && $s->del();
    },

];