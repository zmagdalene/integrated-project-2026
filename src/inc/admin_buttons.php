<div id="adminMode">
    <?php foreach ($adminControls as $action => $item) { ?>
        <a href="<?= h($item['url']) ?>?id=<?= h($s->id) ?>" class="button <?= $action ?>">
            <i class="<?= h($item['icon']) ?>"></i>
            <p><?= h($item['text']) ?></p>
        </a>
    <?php } ?>
</div>