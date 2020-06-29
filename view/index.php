<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Sonsie+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=ZCOOL+KuaiLe&amp;subset=chinese-simplified" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/css/demo.css">
</head>

<body>
<header>
    <h1>你好世界!</h1>
</header>

<nav> <!-- 本站统一的导航栏 -->
    <ul>
        <li><a href="#">主页</a></li>
        <li><a href="#">page1</a></li>
        <li><a href="#">page2</a></li>
        <li><a href="#">page3</a></li>
        <!-- 共n个导航栏项目，省略…… -->
    </ul>

    <form> <!-- 搜索栏是站点内导航的一个非线性的方式。 -->
        <input type="search" name="q" placeholder="要搜索的内容">
        <input type="submit" value="搜索">
    </form>
</nav>

<main> <!-- 网页主体内容 -->
    <article>
        <!-- 此处包含一个 article（一篇文章），内容略…… -->
        <p>程序执行时间:<?= _(microtime(true) - SYS_TIME) ?></p>

        <?= _('<script>alert("悄悄做些坏事情");</script>') ?>

    </article>
    <aside>
        <h2>相关链接</h2>
        <ul>
            <li><a href="/robot.txt" download="robot.txt">下载</a>robot</li>
            <li><a href="https://validator.w3.org/">html validator</a></li>
        </ul>
    </aside>
</main>

<footer>
    <p>© <?=date('Y')?> 保留所有权利</p>
</footer>
<script defer="defer" src="/js/demo.js" type="text/javascript"></script>
</body>
</html>