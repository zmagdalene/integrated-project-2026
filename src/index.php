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

    $financeStories = Story::findAll($options = ['limit' => 4, 'offset' => 4]);

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
    <?php include './lib/head_Content.php' ?>
    <title>Newspaper</title>
</head>

<body>


    <div class="container largeComp">

        <div class="width-12 greyLine"></div>

        <div class="width-10 mainStory">

            <div class="title">
                <h1>TODAY'S NEWS</h1>
            </div>

            <?php foreach ($topStory as $s) { ?>

                <a href="">
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

                    <a href="">

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

                <a href="">
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

                <a href="">
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

                <a href="">
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

                    <a href="">

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

                <a href="">
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

                <div class="story">

                    <a href="">

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

        <div class="width-4 trending">

            <?php foreach ($financeStories as $s) { ?>

                <div class="story">

                    <a href="">

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

        <?php foreach ($topStory as $s) { ?>
            <div class="width-4 newsComp">

                <a href="">
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

</body>

</html>