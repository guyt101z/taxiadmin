<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <a href="<?php echo url_for('recaudacion/index') ?>?page=1<?php if ($idMovil) echo '&idMovil=' . $idMovil ?><?php if ($idChofer) echo '&idChofer=' . $idChofer ?>">
            <?php echo image_tag('app/pag/first.png', 'alt="Primer página" title="Primer página"') ?>
        </a>

        <a href="<?php echo url_for('recaudacion/index') ?>?page=<?php echo $pager->getPreviousPage() ?><?php if ($idMovil) echo '&idMovil=' . $idMovil ?><?php if ($idChofer) echo '&idChofer=' . $idChofer ?>">
            <?php echo image_tag('app/pag/previous.png', 'alt="Página anterior" title="Página anterior"') ?>
        </a>

        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <?php echo $page ?>
            <?php else: ?>
                <a href="<?php echo url_for('recaudacion/index') ?>?page=<?php echo $page ?><?php if ($idMovil) echo '&idMovil=' . $idMovil ?><?php if ($idChofer) echo '&idChofer=' . $idChofer ?>"><?php echo $page ?></a>
            <?php endif; ?>
        <?php endforeach; ?>

        <a href="<?php echo url_for('recaudacion/index') ?>?page=<?php echo $pager->getNextPage() ?><?php if ($idMovil) echo '&idMovil=' . $idMovil ?><?php if ($idChofer) echo '&idChofer=' . $idChofer ?>">
            <?php echo image_tag('app/pag/next.png', 'alt="Página siguiente" title="Página siguiente"') ?>
        </a>

        <a href="<?php echo url_for('recaudacion/index') ?>?page=<?php echo $pager->getLastPage() ?><?php if ($idMovil) echo '&idMovil=' . $idMovil ?><?php if ($idChofer) echo '&idChofer=' . $idChofer ?>">
            <?php echo image_tag('app/pag/last.png', 'alt="Última página" title="Última página"') ?>
        </a>
    </div>
<?php endif; ?>

<div class="pagination_desc">
    <strong><?php echo $pager->getNbResults() ?></strong> recaudaciones

    <?php if ($pager->haveToPaginate()): ?>
        - página <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
    <?php endif; ?>
</div>
