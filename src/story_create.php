<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';
$adminControls = require_once "./inc/admin_controls.php";
$adminData = require_once "./inc/admin_popups.php";
$common = $adminData['common'];
$default = $adminData['popups']['default'];

startSession();

try {
    $categories = Category::findAll();
    $authors = Author::findAll();
    $locations = Location::findAll();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Create Story</title>
</head>

<body>
    <div class="container">
        <div class="width-12 flash-message">
            <?php require_once "./inc/flash_message.php"; ?>
        </div>
    </div>

    <?php include './inc/deleteDialog.php' ?>
    <?php include './inc/adminDialog.php' ?>

    <div class="header">
        <h1>THE FINANCE JOURNAL</h1>
        <?php require_once "./lib/navbar.php"; ?>
    </div>

    <div class="container">
        <div class="width-12 inputForm">

            <div class="title">
                <h1>Create Story</h1>
            </div>

            <div class="form">
                <form action="story_store.php" method="POST" enctype="multipart/form-data" novalidate>

                    <div class="input">
                        <label for="headline">Headline:</label>
                        <div>
                            <input type="text" id="headline" name="headline" value="<?= old('headline') ?>" required>
                            <p class="error"><?= error('headline') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label for="short_headline">Short Headline:</label>
                        <div>
                            <input type="text" id="short_headline" name="short_headline" value="<?= old('short_headline') ?>" required>
                            <p class="error"><?= error('short_headline') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label for="subheadline">Subheadline:</label>
                        <div>
                            <input type="text" id="subheadline" name="subheadline" value="<?= old('subheadline') ?>" required>
                            <p class="error"><?= error('subheadline') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label for="article">Article:</label>
                        <div>
                            <textarea name="article" id="article" rows="5" required><?= old('article') ?></textarea>
                            <p class="error"><?= error('article') ?></p>
                        </div>
                    </div>

                    <div class="selects">

                        <div class="input inputSelect">
                            <label for="author_id">Author:</label>
                            <div>
                                <select name="author_id" id="author_id" required>
                                    <option value="">---Select Author---</option>
                                    <?php foreach ($authors as $a) { ?>
                                        <option value="<?= h($a->id) ?>" <?= chosen('author_id', $a->id) ? 'selected' : '' ?>><?= h($a->first_name), " ", h($a->last_name) ?></option>
                                    <?php } ?>
                                </select>
                                <p class="error"><?= error('author_id') ?></p>
                            </div>
                        </div>

                    </div>

                    <div class="input inputSelect">
                        <label for="category_id">Category:</label>
                        <div>
                            <select name="category_id" id="category_id" required>
                                <option value="">---Select Category---</option>
                                <?php foreach ($categories as $c) { ?>
                                    <option value="<?= h($c->id) ?>" <?= chosen('category_id', $c->id) ? 'selected' : '' ?>><?= h($c->name) ?></option>
                                <?php } ?>
                            </select>
                            <p class="error"><?= error('category_id') ?></p>
                        </div>
                    </div>

                    <div class="input inputSelect">
                        <label for="location_id">Location:</label>
                        <div>
                            <select name="location_id" id="location_id" required>
                                <option value="">---Select Location---</option>
                                <?php foreach ($locations as $l) { ?>
                                    <option value="<?= h($l->id) ?>" <?= chosen('location_id', $l->id) ? 'selected' : '' ?>><?= h($l->name) ?></option>
                                <?php } ?>
                            </select>
                            <p class="error"><?= error('location_id') ?></p>
                        </div>
                    </div>

                    <div class="input">
                        <label for="img_url" class="special">Story Cover Image:</label>
                        <div>
                            <input type="file" name="img_url" id="img_url" accept="image/*" value="" required>
                            <p class="error"><?= error('img_url') ?></p>
                        </div>
                    </div>

                    <!-- TODO: Add fields for short_headline, subheadline, img_url, author, category, and location -->

                    <button type="submit" class="button">Create Story</button>
                </form>
            </div>
        </div>
    </div>

    <div class="gap"></div>

    <script>
        const popupData = <?= json_encode($adminData) ?>;
    </script>
    <script src="js/functions.js"></script>
    <script src="js/crud.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/delete.js"></script>
</body>

</html>

<?php
// TODO: Clear form data and errors from the session after displaying the form
clearFormData();
clearFormErrors(); ?>