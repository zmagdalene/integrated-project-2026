<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }
    if (!array_key_exists('id', $_GET)) {
        throw new Exception('No story ID provided.');
    }
    $id = $_GET['id'];

    $story = Story::findById($id);
    if ($story === null) {
        throw new Exception("Story not found.");
    }

    $categories = Category::findAll();
    $authors = Author::findAll();
    $locations = Location::findAll();
} catch (PDOException $e) {
    setFlashMessage('error', 'Error: ' . $e->getMessage());
    redirect('/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './inc/head_content.php'; ?>
    <title>Edit Story</title>
</head>

<body>
    <?php require_once "./lib/navbar.php"; ?>

    <div class="container">
        <div class="width-12">
            <?php require './inc/flash_message.php'; ?>
        </div>
        <div class="container">
            <div class="width-12 title">
                <h1>Edit Story</h1>
            </div>

            <div class="width-8 inputForm">
                <div class="form">
                    <form action="story_store.php?id=<?= $story->id ?>" method="POST" enctype="multipart/form-data" novalidate>

                        <input type="hidden" id="id" name="id" value="<?= old('id', $story->id) ?>">

                        <div class="input">
                            <label for="headline">Headline:</label>
                            <div>
                                <input type="text" id="headline" name="headline" value="<?= old('headline', $story->headline) ?>" required>
                                <p class="error"><?= error('headline') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="short_headline">Short Headline:</label>
                            <div>
                                <input type="text" id="short_headline" name="short_headline" value="<?= old('short_headline', $story->short_headline) ?>" required>
                                <p class="error"><?= error('short_headline') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="subheadline">Subheadline:</label>
                            <div>
                                <input type="text" id="subheadline" name="subheadline" value="<?= old('subheadline', $story->subheadline) ?>" required>
                                <p class="error"><?= error('subheadline') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="article">Article:</label>
                            <div>
                                <textarea name="article" id="article" rows="5" required><?= old('article', $story->article) ?></textarea>
                                <p class="error"><?= error('article') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="author_id">Author:</label>
                            <div>
                                <select name="author_id" id="author_id" required>
                                    <option value="">---Select Author---</option>
                                    <?php foreach ($authors as $a) { ?>
                                        <option value="<?= h($a->id) ?>" <?= chosen('author_id', $a->id, $story->author_id) ? 'selected' : '' ?>><?= h($a->first_name), " ", h($a->last_name) ?></option>
                                    <?php } ?>
                                </select>
                                <p class="error"><?= error('author_id') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="category_id">Category:</label>
                            <div>
                                <select name="category_id" id="category_id" required>
                                    <option value="">---Select Category---</option>
                                    <?php foreach ($categories as $c) { ?>
                                        <option value="<?= h($c->id) ?>" <?= chosen('category_id', $c->id, $story->category_id) ? 'selected' : '' ?>><?= h($c->name) ?></option>
                                    <?php } ?>
                                </select>
                                <p class="error"><?= error('category_id') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="location_id">Location:</label>
                            <div>
                                <select name="location_id" id="location_id" required>
                                    <option value="">---Select Location---</option>
                                    <?php foreach ($locations as $l) { ?>
                                        <option value="<?= h($l->id) ?>" <?= chosen('location_id', $l->id, $story->location_id) ? 'selected' : '' ?>><?= h($l->name) ?></option>
                                    <?php } ?>
                                </select>
                                <p class="error"><?= error('location_id') ?></p>
                            </div>
                        </div>

                        <div class="input">
                            <label for="img_url" class="special">Story Cover Image:</label>
                            <div>
                                <input type="file" name="img_url" id="img_url" accept="image/*">
                                <p class="error"><?= error('img_url') ?></p>
                            </div>
                        </div>

                        <!-- TODO: Add fields for short_headline, subheadline, img_url, author, category, and location -->

                        <button type="submit" class="button">Update Story</button>
                    </form>
                </div>
            </div>

            <div class="width-4 preview">
                <h2>Preview</h2>
                <div class="newsComp">

                    <div class="content">
                        <img src="/<?= $story->img_url ?>">

                        <div class="textHolder">

                            <div class="redLine"></div>

                            <h2><?= h($story->headline) ?></h2>

                            <div class="text">
                                <p><?= h($story->subheadline) ?></p>
                                <?php $author = Author::findById($story->author_id); ?>
                                <h6 class="author">- <?= h($author->first_name . " " . $author->last_name) ?></h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>

<?php
// TODO: Clear form data and errors from the session after displaying the form
clearFormData();
clearFormErrors(); ?>