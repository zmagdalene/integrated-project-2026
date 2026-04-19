    <dialog id="adminPopup">

        <div class="head">
            <h3><?= h($common['logo']) ?></h3>
            <div class="exit">
                <h4><?= h($common['exit']) ?></h4>
            </div>
            <p id="popupText"><?= h($default['text']) ?></p>
        </div>

        <div class="cards" id="popupCards">
            <?php foreach ($default['cards'] as $type => $item) { ?>
                <div class="card" data-type="<?= h($type) ?>">
                    <i class="<?= h($item['icon']) ?>"></i>
                    <h4><?= h($item['text']) ?></h4>
                </div>
            <?php } ?>
        </div>

        <i id="popupIcon"></i>

        <div class="input" id="popupInput"></div>

    </dialog>

    <div id="adminButton">
        <img src="assets/button.png" alt="adminButton">
    </div>