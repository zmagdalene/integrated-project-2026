<?php
require_once './lib/config.php';
require_once './lib/global.php';
require_once './lib/session.php';

startSession();

try {
    $authors = Author::findAll();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Upload Author</title>
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
            <h1>Manage Authors</h1>
        </div>
    </div>

    <div class="container">
        <div class="width-4">
            <h3>New Author</h3>

            <form action="author_store.php" method="POST" enctype="multipart/form-data" novalidate>

                <div class="formRow">
                    <div class="input textInput">
                        <label for="first_name">First Name:</label>
                        <div>
                            <input type="text" id="first_name" name="first_name" value="<?= old('first_name') ?>" required>
                            <p class="error"><?= error('first_name') ?></p>
                        </div>
                    </div>

                    <div class="input textInput">
                        <label for="last_name">Last Name:</label>
                        <div>
                            <input type="text" id="last_name" name="last_name" value="<?= old('last_name') ?>" required>
                            <p class="error"><?= error('last_name') ?></p>
                        </div>
                    </div>

                </div>
                <button type="submit" class="selectButton">Upload Author</button>
            </form>
        </div>

        <div class="widwth-2"></div>

        <div class="width-6">
            <h3>Delete Author</h3>
            <div class="list">
                <?php foreach ($authors as $a) { ?>
                    <a href="author_delete.php?id=<?= h($a->id) ?>">
                        <p><?= h($a->first_name), " ", h($a->last_name) ?> </p>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// TODO: Clear form data and errors from the session after displaying the form
clearFormData();
clearFormErrors(); ?>