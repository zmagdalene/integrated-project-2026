<?php
require_once "./lib/config.php";
require_once "./lib/global.php";
require_once './lib/session.php';
$adminControls = require_once "./inc/admin_controls.php";
$adminData = require_once "./inc/admin_popups.php";
$common = $adminData['common'];
$default = $adminData['popups']['default'];

try {
    $stories = Story::findAll($options = ['limit' => 3, 'offset' => 1]);

    $topStory = Story::findAll($options = ['oder_by' => 'created_at', 'limit' => 1]);
    $trendingStories = Story::findAll($options = ['order_by' => 'created_at', 'limit' => 4, 'offset' => 1]);

    $techStories = Story::findByCategory(1, $options = ['limit' => 3, 'offset' => 1]);

    $govStories = Story::findByCategory(3, $options = ['limit' => 4, 'offset' => 1]);
    $topGovStory = Story::findByCategory(3, $options = ['limit' => 1]);

    $businessStories = Story::findByCategory(2, $options = ['limit' => 3]);

    $stockStories = Story::findByCategory(5, $options = ['limit' => 4]);
    $topStockStory = Story::findByCategory(5, $options = ['limit' => 1]);

    $energyStories = Story::findByCategory(4, $options = ['limit' => 3]);

    $moreNews = Story::findAll($options = ['limit' => 8, 'order_by' => 'updated_at', 'order' => 'DESC']);

    $category = Category::findAll();
    $author = Author::findAll();
} catch (Exception $e) {
    echo $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './inc/head_Content.php' ?>
    <title>Newspaper</title>
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
                <h1>TODAY'S NEWS</h1>
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
            <h1>TECH</h1>
        </div>

        <?php foreach ($techStories as $s) { ?>
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

    <div class="container largeComp">

        <div class="width-12 greyLine"></div>

        <div class="width-10 mainStory">

            <div class="title">
                <h1>GOVERNMENT</h1>
            </div>

            <?php foreach ($topGovStory as $s) { ?>

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
            <h4>Recent Updates</h4>


            <?php foreach ($govStories as $s) { ?>

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
            <h1>BUSINESS</h1>
        </div>

        <?php foreach ($businessStories as $s) { ?>
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

    <div class="container largeComp">

        <div class="width-12 greyLine"></div>

        <div class="width-10 mainStory">

            <div class="title">
                <h1>STOCKS</h1>
            </div>

            <?php foreach ($topStockStory as $s) { ?>

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
            <h4>Top Sellers</h4>


            <?php foreach ($stockStories as $s) { ?>

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

                    <?php $story = $s;
                    include "./inc/admin_buttons.php" ?>

                </div>

            <?php } ?>

        </div>

    </div>

    <div class="container">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title">
            <h1>ENERGY</h1>
        </div>

        <?php foreach ($energyStories as $s) { ?>
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

    <div class="container moreNews">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title">
            <h1>MORE NEWS</h1>
        </div>

        <div class="width-12">
            <div class="trending story">

                <?php foreach ($moreNews as $s) { ?>

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