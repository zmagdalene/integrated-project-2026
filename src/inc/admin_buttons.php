<div class="adminMode hidden">
    <?php foreach ($adminControls as $action => $item) { ?>
        <a href="<?= h($item['url']) ?>?id=<?= h($s->id) ?>" class="button <?= $action ?>" data-story-id="<?= h($s->id) ?>" data-headline="<?= h($s->headline) ?>">
            <i class="<?= h($item['icon']) ?>"></i>
            <p><?= h($item['text']) ?></p>
        </a>
    <?php } ?>
</div>