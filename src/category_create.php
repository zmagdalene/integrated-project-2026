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
    $category = Category::findAll($options = ['order_by' => 'ASC']);
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Upload Category</title>
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
                <h1>Create Category</h1>
            </div>

            <div class="form">
                <h3>New Category</h3>

                <form action="category_store.php" method="POST" enctype="multipart/form-data" novalidate>

                    <div class="formRow">
                        <div class="input textInput">
                            <label for="name">Category Label:</label>
                            <div>
                                <input type="text" id="name" name="name" value="<?= old('name') ?>" required>
                            </div>
                        </div>

                        <button type="submit" class="button selectButton">Upload Category</button>
                    </div>
                    <p class="error"><?= error('name') ?></p>
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