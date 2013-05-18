<?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
        <a href="<?php echo url_for('chofer/index') ?>?page=1">
            <?php echo image_tag('app/pag/first.png', 'alt="Primer página" title="Primer página"') ?>
        </a>

        <a href="<?php echo url_for('chofer/index') ?>?page=<?php echo $pager->getPreviousPage() ?>">
            <?php echo image_tag('app/pag/previous.png', 'alt="Página anterior" title="Página anterior"') ?>
        </a>

        <?php foreach ($pager->getLinks() as $page): ?>
            <?php if ($page == $pager->getPage()): ?>
                <?php echo $page ?>
            <?php else: ?>
                <a href="<?php echo url_for('chofer/index') ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
            <?php endif; ?>
        <?php endforeach; ?>

        <a href="<?php echo url_for('chofer/index') ?>?page=<?php echo $pager->getNextPage() ?>">
            <?php echo image_tag('app/pag/next.png', 'alt="Página siguiente" title="Página siguiente"') ?>
        </a>

        <a href="<?php echo url_for('chofer/index') ?>?page=<?php echo $pager->getLastPage() ?>">
            <?php echo image_tag('app/pag/last.png', 'alt="Última página" title="Última página"') ?>
        </a>
    </div>
<?php endif; ?>

<div class="pagination_desc">
    <strong><?php echo $pager->getNbResults() ?></strong> choferes

    <?php if ($pager->haveToPaginate()): ?>
        - página <strong><?php echo $pager->getPage() ?>/<?php echo $pager->getLastPage() ?></strong>
    <?php endif; ?>
</div>
