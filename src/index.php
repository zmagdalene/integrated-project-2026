<?php
require_once "./lib/config.php";
require_once "./lib/global.php";
$adminControls = require_once "./inc/admin_controls.php";
$adminData = require_once "./inc/admin_popups.php";
$common = $adminData['common'];
$default = $adminData['popups']['default'];

try {
    $stories = Story::findAll($options = ['limit' => 3, 'offset' => 1]);

    $topStory = Story::findAll($options = ['limit' => 1]);
    $trendingStories = Story::findAll($options = ['limit' => 4, 'offset' => 1]);

    $techStories = Story::findByCategory(1, $options = ['limit' => 3]);

    $govStories = Story::findByCategory(3, $options = ['limit' => 4, 'offset' => 1]);
    $topGovStory = Story::findByCategory(3, $options = ['limit' => 1]);

    $businessStories = Story::findByCategory(2, $options = ['limit' => 3]);

    $stockStories = Story::findByCategory(5, $options = ['limit' => 4]);
    $topStockStory = Story::findByCategory(5, $options = ['limit' => 1]);

    $energyStories = Story::findByCategory(4, $options = ['limit' => 3]);

    $editorsPick = Story::findAll($options = ['limit' => 8, 'order_by' => 'updated_at', 'order' => 'DESC']);

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

    <div class="banner">
        <div class="flash-message">
            <?php require_once "./inc/flash_message.php"; ?>
        </div>
    </div>

    <dialog id="adminPopup" data-mode="user">

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

                <a href="view_story.php?id=<?= h($s->id) ?>">
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

                <?php include "./inc/admin_buttons.php" ?>

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

                <?php include "./inc/admin_buttons.php" ?>

            <?php } ?>

        </div>

    </div>

    <div class="container">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title left">
            <h1>TECH</h1>
        </div>

        <?php foreach ($techStories as $s) { ?>
            <div class="width-4 newsComp">

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

                <?php include "./inc/admin_buttons.php" ?>

            </div>
        <?php } ?>

    </div>

    <div class="container">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title left">
            <h1>BUSINESS</h1>
        </div>

        <?php foreach ($businessStories as $s) { ?>
            <div class="width-4 newsComp">

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

                <?php include "./inc/admin_buttons.php" ?>

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

                <a href="view_story.php?id=<?= h($s->id) ?>">
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

                <?php include "./inc/admin_buttons.php" ?>

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

                    <?php include "./inc/admin_buttons.php" ?>

                </div>

            <?php } ?>

        </div>

    </div>

    <div class="container">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title left">
            <h1>ENERGY</h1>
        </div>

        <?php foreach ($energyStories as $s) { ?>
            <div class="width-4 newsComp">

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

                <?php include "./inc/admin_buttons.php" ?>

            </div>
        <?php } ?>

    </div>

    <div class="container personalFinance">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title left">
            <h1>MORE NEWS</h1>
        </div>

        <div class="width-12">
            <div class="width-4 trending">

                <?php foreach ($editorsPick as $e) { ?>

                    <a href="view_story.php?id=<?= h($e->id) ?>">
                        <div class="story">
                            <div class="pic">
                                <img src="/<?= $e->img_url ?>">
                            </div>
                            <div class="textHolder">

                                <div class="category">
                                    <?php $category = Category::findById($e->category_id) ?>
                                    <h6 class="red"><?= $category->name ?></h6>
                                    <?php $author = Author::findById($e->author_id) ?>
                                    <h6>/ <?= $author->first_name . " " . $author->last_name ?></h6>
                                </div>

                                <h5><?= $e->short_headline ?></h5>
                                <p class="time">2h ago</p>

                            </div>

                        </div>
                    </a>

                    <?php include "./inc/admin_buttons.php" ?>

                <?php } ?>

            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">

            <div class="width-12 footerContent">
                <h1>THE FINANCIAL JOURNAL</h1>
                <div class="greyLine"></div>

                <div class="footerBlocks">

                    <div class="footerBlock">
                        <h4>Explore</h4>
                        <ul>
                            <?php foreach ($categories as $c) { ?>
                                <li><a href="category.php?id=<?= $c->id ?>"><?= $c->name ?> News</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="footerBlock">
                        <h4>Support</h4>
                        <ul>
                            <li><a href="">About Us</a></li>
                            <li><a href="">Help Center</a></li>
                            <li><a href="">Contact Us</a></li>
                            <li><a href="">Accessibility</a></li>
                            <li><a href="">Careers</a></li>
                        </ul>
                    </div>

                    <div class="footerBlock">
                        <h4>Legal & Privacy</h4>
                        <ul>
                            <li><a href="">Terms & Conditions</a></li>
                            <li><a href="">Privacy Policy</a></li>
                            <li><a href="">Cookie Policy</a></li>
                            <li><a href="">Manage Cookies</a></li>
                            <li><a href="">Copyright</a></li>
                        </ul>
                    </div>

                </div>

                <div class="foot">
                    <li>© 2026 Financial Journal News & Media Limited or its affiliated companies. All rights reserved. (dcr)</li>
                </div>

            </div>
        </div>
        <script>
            const popupData = <?= json_encode($adminData) ?>;
        </script>
        <script src="js/functions.js"></script>
        <script src="js/admin.js"></script>
        <script src="js/delete.js"></script>
</body>

</html>