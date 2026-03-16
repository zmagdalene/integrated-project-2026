<?php
require_once "./lib/config.php";
require_once "./lib/global.php";

try {
    $stories = Story::findAll($options = ['limit' => 3, 'offset' => 1]);

    $topStory = Story::findAll($options = ['limit' => 1]);
    $trendingStories = Story::findAll($options = ['limit' => 4, 'offset' => 1]);

    $techStories = Story::findByCategory(1, $options = ['limit' => 3]);

    $businessStories = Story::findByCategory(2, $options = ['limit' => 3]);

    $stockStories = Story::findByCategory(5, $options = ['limit' => 4]);
    $topStockStory = Story::findByCategory(5, $options = ['limit' => 1]);

    $energyStories = Story::findByCategory(4, $options = ['limit' => 3]);

    $financeStories = Story::findAll($options = ['limit' => 4]);

    $financeStories2 = Story::findAll($options = ['limit' => 4, 'offset' => 4]);

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
    <div class="flash-message">
        <?php require_once "./inc/flash_message.php"; ?>
    </div>

    <div class="overlay">
    </div>

    <div class="admin_overlay">
    </div>

    <div class="admin_content">
        <div class="hiddenText">
            <div class="topRow">
                <div class="bootsLogo">
                    <img src="Images/Icons/Boots Logo top left.png" alt="bootsLogo">
                </div>

                <div class="exit">
                    <img src="Images/Admin_Overlay/plus.svg" alt="exit">
                </div>
            </div>
            <p>Your feedback is important to us and will help us to improve our website.
                Please leave feedback about...</p>
            <div class="cards">
                <a href="https://www.bootsreviewpanel.com/">
                    <div class="card">
                        <div class="imageHolder imageHolder01">
                        </div>
                        <h4>An area of this page</h4>
                        <p>Provide feedback about<br>a specific part of this page.</p>
                    </div>
                </a>

                <a
                    href="https://www.boots.ie/contact-us?srsltid=AfmBOoqtjrSPn3es4WvkwelYCCtsLejPb0AaqkNpBu1SJjSIX4McqhFf">
                    <div class="card">
                        <div class="imageHolder imageHolder02">
                        </div>
                        <h4>General feedback</h4>
                        <p>Give general feedback about the website.</p>
                    </div>
                </a>
            </div>

            <div class="text">
                <a href="https://www.getfeedback.com/digital?utm_source=live_button&utm_medium=powered-link">
                    <img src="Images/Feedback_Overlay/icon.svg" alt="icon">
                    <p>Powered by GetFeedback</p>
                </a>
            </div>
        </div>
    </div>

    <div class="adminButton">
        <img src="button/button.png" alt="adminButton">
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

            <?php } ?>
        </div>

        <div class="width-2 trending">
            <h4>Trending</h4>


            <?php foreach ($trendingStories as $s) { ?>

                <div class="story">

                    <a href="view_story.php?id=<?= h($s->id) ?>">

                        <div class="category">
                            <?php $category = Category::findById($s->category_id) ?>
                            <h6><?= $category->name ?></h6>
                            <?php $author = Author::findById($s->author_id) ?>
                            <h6 class="author">/ <?= $author->first_name . " " . $author->last_name ?></h6>
                        </div>

                        <h5><?= $s->short_headline ?></h5>
                        <p class="time">2h ago</p>

                    </a>
                </div>

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

            <?php } ?>
        </div>

        <div class="width-2 trending">
            <h4>Top Sellers</h4>


            <?php foreach ($stockStories as $s) { ?>

                <div class="story">

                    <a href="view_story.php?id=<?= h($s->id) ?>">

                        <div class="category">
                            <?php $category = Category::findById($s->category_id) ?>
                            <h6><?= $category->name ?></h6>
                            <?php $author = Author::findById($s->author_id) ?>
                            <h6 class="author">/ <?= $author->first_name . " " . $author->last_name ?></h6>
                        </div>

                        <h5><?= $s->short_headline ?></h5>
                        <p class="time">2h ago</p>

                    </a>
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
            </div>
        <?php } ?>

    </div>

    <div class="container personalFinance">

        <div class="width-12 greyLine"></div>

        <div class="width-12 title left">
            <h1>PERSONAL FINANCE</h1>
        </div>

        <div class="width-4 trending">

            <?php foreach ($financeStories as $s) { ?>

                <a href="view_story.php?id=<?= h($s->id) ?>">
                    <div class="story">
                        <div class="pic">
                            <img src="/<?= $s->img_url ?>">
                        </div>
                        <div class="textHolder">

                            <div class="category">
                                <?php $category = Category::findById($s->category_id) ?>
                                <h6><?= $category->name ?></h6>
                                <?php $author = Author::findById($s->author_id) ?>
                                <h6 class="author">/ <?= $author->first_name . " " . $author->last_name ?></h6>
                            </div>

                            <h5><?= $s->short_headline ?></h5>
                            <p class="time">2h ago</p>

                        </div>

                    </div>
                </a>

            <?php } ?>

        </div>

        <div class="width-4 trending">

            <?php foreach ($financeStories2 as $s) { ?>

                <a href="view_story.php?id=<?= h($s->id) ?>">
                    <div class="story">

                        <div class="pic">
                            <img src="/<?= $s->img_url ?>">
                        </div>

                        <div class="textHolder">

                            <div class="category">
                                <?php $category = Category::findById($s->category_id) ?>
                                <h6><?= $category->name ?></h6>
                                <?php $author = Author::findById($s->author_id) ?>
                                <h6 class="author">/ <?= $author->first_name . " " . $author->last_name ?></h6>
                            </div>

                            <h5><?= $s->short_headline ?></h5>
                            <p class="time">2h ago</p>

                        </div>

                    </div>
                </a>

            <?php } ?>

        </div>

        <?php foreach ($topStory as $s) { ?>
            <div class="width-4 newsComp">

                <a href="view_story.php?id=<?= h($s->id) ?>">
                    <div class="content">
                        <img src="/<?= $s->img_url ?>">

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
            </div>
        <?php } ?>

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
        <script src="js/admin.js"></script>
</body>

</html>