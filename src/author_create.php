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
    $authors = Author::findAll($options = ['order']);
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
                <button type="submit" class="button selectButton">Upload Author</button>
            </form>
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