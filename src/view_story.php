<?php
require_once "./lib/config.php";
require_once "./lib/global.php";
$adminControls = require_once "./inc/admin_controls.php";
$adminData = require_once "./inc/admin_popups.php";
$common = $adminData['common'];
$default = $adminData['popups']['default'];

try {
    if (!isset($_GET["id"])) {
        throw new Exception("Story ID not provided.");
    }
    $id = $_GET["id"];
    $s = Story::findById($id);
    if ($s == null) {
        throw new Exception("Story not found.");
    }
    $category = Category::findById($s->category_id);
    $trendingStories = Story::findAll($options = ['order_by' => 'created_at', 'limit' => 6, 'offset' => 1]);
    $related_stories = Story::findByCategory($category->id, $options = array('order_by' => 'updated_at', 'order' => 'DESC'));
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>
<html>

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Story</title>
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

    <div class="gap"></div>

    <div class="container">

        <div class="width-8">
            <p><?= Category::findById($s->category_id)->name ?></p>
            <h1><?= $s->headline ?></h1>
            <p>Location: <?= Location::findById($s->location_id)->name ?></p>
            <?php $author = Author::findById($s->author_id); ?>
            <p>Author: <?= $author->first_name . " " . $author->last_name ?></p>
            <div class="dates flex">
                <p>Published: <?= $s->created_at ?></p>
                <p>Updated: <?= $s->updated_at ?></p>
            </div>
            <h3><?= $s->subheadline ?></h3>

            <img src="<?= h($s->img_url) ?>" />

            <div class="article">
                <p><?= $s->article ?></p>
            </div>

            <?php $story = $s;
            include "./inc/admin_buttons.php" ?>
        </div>

        <div class="width-1"></div>

        <div class="width-2">
            <div class="trending sticky">
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
    </div>

    <div class="container moreNews">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title">
            <h1>RELATED STORIES</h1>
        </div>

        <div class="width-12">
            <div class="trending story">

                <?php foreach ($related_stories as $s) { ?>

                    <a href="view_story.php?id=<?= h($s->id) ?>">
                        <div class="story">
                            <div class="pic">
                                <img src="/<?= $s->img_url ?>">
                            </div>
                            <div class="textHolder">

                                <div class="category">
                                    <?php $category = Category::findById($s->category_id) ?>
                                    <h6 class="red"><?= $category->name ?></h6>
                                    <?php $author = Author::findById($s->author_id) ?>
                                    <h6>/ <?= $author->first_name . " " . $author->last_name ?></h6>
                                </div>

                                <h5><?= $s->headline ?></h5>
                                <p class="time">2h ago</p>

                            </div>

                        </div>
                    </a>

                    <?php $story = $s;
                    include "./inc/admin_buttons.php" ?>

                <?php } ?>

            </div>
        </div>
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