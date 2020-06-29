<?php

use App\s\MenuServer;

?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="<?= QN_HOST ?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light"><?= env('app_name') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= QN_HOST ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= \App\s\UserServer::loginInfo()->name ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php foreach (MenuServer::getMenu(URI) as $item) : ?>
                    <li class="nav-item <?= isset($item['subitems']) && $item['subitems'] ? 'has-treeview' : '' ?> <?= isset($item['subitem_active']) && $item['subitem_active'] ? 'menu-open' : '' ?>">
                        <a href="<?= $item['url'] ?>"
                           class="nav-link <?= isset($item['active']) && $item['active'] ? 'active' : '' ?> <?= isset($item['subitem_active']) && $item['subitem_active'] ? 'active' : '' ?>">
                            <i class="nav-icon <?= $item['icon'] ?>"></i>
                            <p>
                                <?= $item['title'] ?>
                                <?php if (isset($item['subitems']) && $item['subitems']) : ?>
                                    <i class="right fas fa-angle-left"></i>
                                <?php endif; ?>
                            </p>
                        </a>
                        <?php if (isset($item['subitems']) && $item['subitems']) : ?>
                            <ul class="nav nav-treeview">
                                <?php foreach ($item['subitems'] as $item_1) : ?>
                                    <li class="nav-item">
                                        <a href="<?= $item_1['url'] ?>"
                                           class="nav-link <?= $item_1['active'] ? 'active' : '' ?>">
                                            <i class="<?= $item_1['icon']?:'far fa-circle' ?> nav-icon"></i>
                                            <p><?= $item_1['title'] ?></p>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>