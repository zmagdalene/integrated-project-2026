<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

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
    <?php require_once "./lib/navbar.php"; ?>

    <div class="container">
        <div class="width-12">
            <?php require_once "./inc/flash_message.php"; ?>
        </div>
    </div>

    <div class="container">
        <div class="width-12">
            <h1>Create Story</h1>
        </div>
    </div>

    <div class="container">
        <div class="width-12">
            <form action="story_store.php" method="POST">

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

                <div class="input">
                    <label for="author_id">Author:</label>
                    <div>
                        <select name="author_id" id="author_id">
                            <?php foreach ($authors as $a) { ?>
                                <option value="<?= $a->id ?>" <?= chosen('author_id', $a->id) ? 'selected' : '' ?>><?= $a->first_name, " ", $a->last_name ?></option>
                            <?php } ?>
                        </select>
                        <p class="error"><?= error('author_id') ?></p>
                    </div>
                </div>

                <div class="input">
                    <label for="category_id">Category:</label>
                    <div>
                        <select name="category_id" id="category_id">
                            <?php foreach ($categories as $c) { ?>
                                <option value="<?= $c->id ?>" <?= chosen('category_id', $c->id) ? 'selected' : '' ?>><?= $c->name ?></option>
                            <?php } ?>
                        </select>
                        <p class="error"><?= error('category_id') ?></p>
                    </div>
                </div>

                <div class="input">
                    <label for="location_id">Location:</label>
                    <div>
                        <select name="location_id" id="location_id">
                            <?php foreach ($locations as $l) { ?>
                                <option value="<?= $l->id ?>" <?= chosen('location_id', $l->id) ? 'selected' : '' ?>><?= $l->name ?></option>
                            <?php } ?>
                        </select>
                        <p class="error"><?= error('location_id') ?></p>
                    </div>
                </div>

                <div class="input">
                    <label for="img_url" class="special">Story Cover Image:</label>
                    <div>
                        <input type="file" name="img_url" id="img_url" accept="image/*" value="" required>
                        <p><?= error('img_url') ?></p>
                    </div>
                </div>

                <!-- TODO: Add fields for short_headline, subheadline, img_url, author, category, and location -->

                <button type="submit">Create Story</button>
            </form>
        </div>
    </div>
</body>

</html>

<?php
// TODO: Clear form data and errors from the session after displaying the form