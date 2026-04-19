<?php
require_once "./lib/config.php";
require_once "./lib/global.php";
require_once './lib/session.php';
$adminControls = require_once "./inc/admin_controls.php";
$adminData = require_once "./inc/admin_popups.php";
$common = $adminData['common'];
$default = $adminData['popups']['default'];

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Category ID not provided.");
    }
    $categoryId = $_GET["id"];
    $category = Category::findById($categoryId);
    if ($category == null) {
        throw new Exception("Category not found.");
    }
    // $stories = Story::findByCategory($categoryId);
    $stories = Story::findByCategory($categoryId, $options = array('limit' => 3, 'offset' => 3));
    $topStory = Story::findByCategory($categoryId, $options = ['limit' => 1]);
    $trendingStories = Story::findByCategory($categoryId, $options = ['limit' => 4, 'offset' => 1]);
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Stories: <?= h($category->name) ?></title>
</head>

<body>
    <?php include './inc/deleteDialog.php' ?>
    <?php include './inc/adminDialog.php' ?>

    <div class="banner">
        <div class="flash-message">
            <?php require_once "./inc/flash_message.php"; ?>
        </div>
    </div>

    <div class="header">
        <h1>THE FINANCE JOURNAL</h1>
        <?php require_once "./lib/navbar.php"; ?>
    </div>

    <div class="container largeComp">

        <div class="width-12 greyLine"></div>

        <div class="width-10 mainStory">

            <div class="title">
                <h1>TOP <?= h($category->name) ?></h1>
            </div>

            <?php foreach ($topStory as $s) { ?>

                <a href="view_story.php?id=<?= h($s->id) ?>" class="story">
                    <div class="content">

                        <div class="redLine"></div>

                        <div class="textHolder">

                            <h2><?= $s->headline ?></h2>

                            <div class="text">
                                <p><?= $s->subheadline ?></p>
                                <?php $author = Author::findById($s->author_id); ?>
                                <h6 class="author">- <?= h($author->first_name . " " . $author->last_name) ?></h6>
                            </div>

                        </div>

                    </div>


                    <div class="pic">
                        <img src="/<?= $s->img_url ?>">
                        <?php $category = Category::findById($s->category_id); ?>
                        <p class="category"><?= h($category->name) ?></p>
                    </div>
                </a>

                <?php $story = $s;
                include "./inc/admin_buttons.php" ?>

            <?php } ?>
        </div>

        <div class="width-2 trending">
            <h4>Trending</h4>


            <?php foreach ($trendingStories as $s) { ?>

                <div class="story">

                    <a href="view_story.php?id=<?= h($s->id) ?>">

                        <div class="category">
                            <?php $category = Category::findById($s->category_id) ?>
                            <h6 class="red"><?= $category->name ?></h6>
                            <?php $author = Author::findById($s->author_id) ?>
                            <h6>/ <?= $author->first_name . " " . $author->last_name ?></h6>
                        </div>

                        <h5><?= $s->short_headline ?></h5>
                        <p class="time">2h ago</p>

                    </a>
                </div>

                <?php $story = $s;
                include "./inc/admin_buttons.php" ?>

            <?php } ?>

        </div>

    </div>

    <div class="container">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title">
            <h1><?= h($category->name) ?></h1>
        </div>

        <?php foreach ($stories as $s) { ?>
            <div class="width-4 newsComp story">

                <a href="view_story.php?id=<?= h($s->id) ?>">
                    <div class="content">
                        <img src="/<?= $s->img_url ?>" alt="1">

                        <div class="textHolder">

                            <div class="redLine"></div>

                            <h2><?= h($s->headline) ?></h2>

                            <div class="text">
                                <p><?= h($s->subheadline) ?></p>
                                <?php $author = Author::findById($s->author_id); ?>
                                <h6 class="author">- <?= h($author->first_name . " " . $author->last_name) ?></h6>
                            </div>

                        </div>
                    </div>
                </a>

                <?php $story = $s;
                include "./inc/admin_buttons.php" ?>

            </div>
        <?php } ?>

    </div>

    <?php include "./inc/footer.php" ?>

    <script>
        const popupData = <?= json_encode($adminData) ?>;
    </script>
    <script src="js/functions.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/delete.js"></script>
</body>

</html>