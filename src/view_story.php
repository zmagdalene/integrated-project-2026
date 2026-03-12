<?php
require_once "./lib/config.php";
require_once "./lib/global.php";

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
    $related_stories = Story::findByCategory($category->id, $options = array('limit' => 3, 'order_by' => 'updated_at', 'order' => 'DESC'));
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
    <?php require_once "./inc/flash_message.php"; ?>
    <div class="header">
        <h1>THE FINANCE JOURNAL</h1>
        <?php require_once "./lib/navbar.php"; ?>
    </div>

    <div class="gap"></div>

    <div class="container">

        <div class="width-9">
            <p><?= Category::findById($s->category_id)->name ?></p>
            <h1><?= $s->headline ?></h1>
            <div class="dates">
                <p>Published: <?= $s->created_at ?></p>
                <p>Updated: <?= $s->updated_at ?></p>
            </div>
            <?php $author = Author::findById($s->author_id); ?>
            <p>Author: <?= $author->first_name . " " . $author->last_name ?></p>
            <h3><?= $s->subheadline ?></h3>

            <img src="images/<?= $s->img_url ?>" />

            <div class="article">
                <p><?= $s->article ?></p>
            </div>

            <p>Location: <?= Location::findById($s->location_id)->name ?></p>
        </div>
        <div class="width-12">
            <h2>Related Stories</h2>
            <?php foreach ($related_stories as $rs) { ?>
                <?php if ($rs->id == $s->id) {
                    continue;
                } ?>
                <div>
                    <h3><a href="view_story.php?id=<?= $rs->id ?>"><?= $rs->headline ?></a></h3>
                    <?php $rs_author = Author::findById($rs->author_id); ?>
                    <p>Author: <?= $rs_author->first_name . " " . $rs_author->last_name ?></p>
                    <!-- <p>Category: <?= Category::findById($rs->category_id)->name ?></p> -->
                    <!-- <p>Location: <?= Location::findById($rs->location_id)->name ?></p> -->
                    <!-- <p>Date created: <?= $rs->created_at ?></p> -->
                    <p>Last modified: <?= $rs->updated_at ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>