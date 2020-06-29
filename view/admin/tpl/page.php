<?php
function diy_page($c_page, $t_page)
{
    $i = $c_page - 3;
    ?>
    <ul class="pagination pagination-sm">
        <?php if ($c_page - 1 >= 0): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $c_page - 1 ?>)">&laquo;</a>
            </li>
        <?php endif; ?>
        <?php if (++$i >= 0): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $i ?>)"><?= $i + 1 ?></a>
            </li>
        <?php endif; ?>
        <?php if (++$i >= 0): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $i ?>)"><?= $i + 1 ?></a>
            </li>
        <?php endif; ?>
        <li class="page-item active"><a class="page-link" href="javascript:void(0);"><?= ++$i + 1 ?></a></li>
        <?php if (++$i < $t_page): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $i ?>)"><?= $i + 1 ?></a>
            </li>
        <?php endif; ?>
        <?php if (++$i < $t_page): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $i ?>)"><?= $i + 1 ?></a>
            </li>
        <?php endif; ?>

        <?php if ($c_page + 1 < $t_page): ?>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0);" onclick="load_page(<?= $c_page + 1 ?>)">&raquo;</a>
            </li>
        <?php endif; ?>

    </ul>
<?php } ?>