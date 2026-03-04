<?php
require_once "./lib/config.php";
require_once "./lib/global.php";

try {
    $topStory = Story::findAll($options = ['limit' => 1]);
    $trendingStories = Story::findAll($options = ['limit' => 4, 'offset' => 1]);
    $stories = Story::findAll($options = ['limit' => 3, 'offset' => 1]);
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

        <div class="width-12 title">
            <h1>TODAY'S NEWS</h1>
        </div>

        <div class="width-9 mainStory">

            <?php foreach ($topStory as $s) { ?>
                <div class="text">

                    <a href="">

                        <div class="redLine"></div>

                        <div class="textHolder">


                            <h2><?= $s->headline ?></h2>


                            <div class="greyLine"></div>

                            <div class="text">
                                <p><?= $s->subheadline ?></p>
                                <?php $author = Author::findById($s->author_id); ?>
                                <h6 class="author">- <?= h($author->first_name . " " . $author->last_name) ?></h6>
                            </div>

                        </div>
                    </a>

                </div>


                <div class="pic">
                    <img src="/<?= $s->img_url ?>">
                    <?php $category = Category::findById($s->category_id); ?>
                    <p class="category"><?= h($category->name) ?></p>
                </div>

            <?php } ?>
        </div>

        <div class="width-3 trending">
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

        <div class="width-12 title">
            <h1>TODAY'S NEWS</h1>
        </div>

        <?php foreach ($stories as $s) { ?>
            <div class="width-4 newsComp">

                <a href="">
                    <div class="content">
                        <img src="/<?= $s->img_url ?>" alt="1">

                        <div class="textHolder">

                            <h2><?= h($s->headline) ?></h2>

                            <div class="text">
                                <div class="graphicLine">
                                </div>
                                <p><?= h($s->subheadline) ?></p>
                                <?php $author = Author::findById($s->author_id); ?>
                                <p class="author">- <?= h($author->first_name . " " . $author->last_name) ?></p>
                            </div>

                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

    </div>






</body>

</html>