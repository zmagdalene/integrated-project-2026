<?php
require_once "./lib/config.php";
require_once "./lib/global.php";

try {
    $stories = Story::findAll($options = ['limit' => 4]);
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
    <div class="container">

        <?php foreach ($stories as $s) { ?>
            <div class="width-4 newsComp">
                <li>
                    <a href="">
                        <?php $category = Category::findById($s->category_id); ?>
                        <p class="category"><?= h($category->name) ?></p>
                        <div class="content">
                            <img src="/<?= $s->img_url ?>" alt="1">

                            <div class="textHolder">

                                <div class="title">
                                    <h2><?= h($s->headline) ?></h2>
                                </div>

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
                </li>
            </div>
        <?php } ?>

        <div class="width-4 newsComp">
            <li>
                <a href="">
                    <p class="category">TECH</p>
                    <div class="content">
                        <img src="images/02_Tech's_massive_AI_spend_is_under_scrutiny_ahead_of_earnings._Here’s_what_to_watch.webp"
                            alt="2">

                        <div class="textHolder">

                            <div class="title">
                                <h2>Tech’s massive AI spend is under scrutiny ahead of earnings. Here’s what to watch
                                </h2>
                            </div>

                            <div class="text">
                                <div class="graphicLine">
                                </div>
                                <p>Apple, Meta Platforms, Microsoft and Tesla report earnings this week, after having
                                    shelled out billions on AI infrastructure in 2025 to support massive demand...</p>
                                <p class="author">- Samantha Subin</p>
                            </div>

                        </div>
                    </div>
                </a>
            </li>
        </div>

        <div class="width-4 newsComp">
            <li>
                <a href="">
                    <p class="category">TECH</p>
                    <div class="content">
                        <img src="images/03_This_university_campus_is_heated_by_an_AI_data_center._Your_home_could_be_next.webp"
                            alt="3">

                        <div class="textHolder">

                            <div class="title">
                                <h2>This university campus is heated by an AI data center. Your home could be next</h2>
                            </div>

                            <div class="text">
                                <div class="graphicLine">
                                </div>
                                <p>AI’s energy problem may also be its solution, as hyperscalers and governments are
                                    increasingly exploring opportunities to repurpose excess heat from data centers...
                                </p>
                                <p class="author">- April Roach</p>
                            </div>

                        </div>
                    </div>
                </a>
            </li>
        </div>

        <div class="width-3 trendingComp">
            <h3 class="title2">Trending</h3>

            <ul>
                <li>
                    <div class="content">
                        <div class="graphicLine2"></div>
                        <a href="">
                            <div class="story">
                                <div class="category">
                                    <h4>BUSINESS</h4>
                                    <h4 class="author">/ MARY MCKENNA</h4>
                                </div>
                                <h3>IT, Finance and Construction Lead Irish Salary Rankings</h3>
                                <div class="time">2h ago</div>
                            </div>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="content">
                        <div class="graphicLine2"></div>
                        <a href="">
                            <div class="story">
                                <div class="category">
                                    <h4>GOVERNMENT</h4>
                                    <h4 class="author">/ ANNIECK BAO</h4>
                                </div>
                                <h3>Britain and China Accelerate Business Deals Amid Diplomatic Thaw</h3>
                                <div class="time">4h ago</div>
                            </div>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="content">
                        <div class="graphicLine2"></div>
                        <a href="">
                            <div class="story">
                                <div class="category">
                                    <h4>TECH</h4>
                                    <h4 class="author">/ JULIE BOORSTIN</h4>
                                </div>
                                <h3>SoftBank Unit Teams Up With Intel on AI Memory</h3>
                                <div class="time">30m ago</div>
                            </div>
                        </a>
                    </div>
                </li>

                <li>
                    <div class="content">
                        <div class="graphicLine2"></div>
                        <a href="">
                            <div class="story">
                                <div class="category">
                                    <h4>ENERGY</h4>
                                    <h4 class="author">/ KATIE BRIGHAM</h4>
                                </div>
                                <h3>How nuclear power will drive our energy future</h3>
                                <div class="time">1h ago</div>
                            </div>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="width-4 newsComp newsComp2">
            <li>
                <a href="">
                    <p class="category">TECH</p>
                    <div class="content">
                        <img src="images/04_How_digital_banking_is_not_having_benefits_for_Irish_households.jpg"
                            alt="3">

                        <div class="textHolder">

                            <div class="graphicLine"></div>

                            <div class="title">
                                <h2>How digital banking is not having benefits for Irish households</h2>
                            </div>

                            <div class="text">
                            </div>
                            <p>Analysis: New research has found that digital banking technology is not improving the
                                financial well-being of the squeezed middle in Ireland...</p>
                            <p class="author">- Marie Ryan</p>
                        </div>

                    </div>
                </a>
            </li>
        </div>

        <div class="width-4 newsComp newsComp2">
            <li>
                <a href="">
                    <p class="category">TECH</p>
                    <div class="content">
                        <img src="images/05_8_Irish_game_developers_to_launch_game_prototypes_through_pioneering_IndieDev_Fund.webp"
                            alt="3">

                        <div class="textHolder">

                            <div class="graphicLine"></div>

                            <div class="title">
                                <h2> How the IndieDev Fund Is Powering a New Wave of Irish Game Creators</h2>
                            </div>

                            <div class="graphicLine2"></div>

                            <div class="text">

                                <p>New initiative will support eight Irish developers as they prepare to launch
                                    innovative
                                    game prototypes aimed at international audiences...</p>
                                <p class="author">- Melanie Boylan</p>
                            </div>
                        </div>

                    </div>
                </a>
            </li>
        </div>

        <div class="width-12 largeComp">

            <div class="container">

                <div class="width-4 newsComp newsComp2 newsComp3">
                    <li>
                        <a href="">

                            <div class="graphicLine"></div>

                            <div class="textHolder">

                                <div class="title">
                                    <h2> How the IndieDev Fund Is Powering a New Wave of Irish Game Creators</h2>
                                </div>

                                <div class="graphicLine2"></div>

                                <div class="text">

                                    <p>New initiative will support eight Irish developers as they prepare to launch
                                        innovative
                                        game prototypes aimed at international audiences...</p>
                                    <p class="author">- Melanie Boylan</p>
                                </div>

                            </div>
                        </a>
                    </li>
                </div>

                <div class="width-6 todayComp">

                    <div class="styles">
                        <div class="graphicLine3"></div>
                        <div class="graphicLine3"></div>
                    </div>

                    <div class="image">
                        <h1>TODAY'S NEWS</h1>
                        <div class="graphicLine2"></div>
                        <img src="images/05_8_Irish_game_developers_to_launch_game_prototypes_through_pioneering_IndieDev_Fund.webp"
                            alt="3">
                        <p class="category">TECH</p>
                    </div>

                </div>

                <div class="width-2 trendingComp2">
                    <h3 class="title2">Trending</h3>

                    <ul>
                        <?php foreach ($stories as $s) { ?>
                            <li>

                                <div class="content">
                                    <div class="graphicLine2"></div>
                                    <a href="">
                                        <div class="story">
                                            <div class="category">
                                                <?php $category = Category::findById($s->category_id) ?>
                                                <h4><?= $category->name ?></h4>
                                                <?php $author = Author::findById($s->author_id) ?>
                                                <h4 class="author">/ <?= $author->first_name . " " . $author->last_name ?></h4>
                                            </div>
                                            <h3><?= $s->short_headline ?></h3>
                                            <p class="time">2h ago</p>
                                        </div>
                                    </a>
                                </div>

                            </li>
                        <?php } ?>
                    </ul>
                </div>

            </div>

        </div>

        <div class="width-12 techNews">
            <div class="container">
                <div class="width-12 title">
                    <h1>TECH</h1>
                </div>

                <div class="width-4 newsComp newsComp2">

                    <li>
                        <a href="">
                            <div class="content">
                                <img src="images/05_8_Irish_game_developers_to_launch_game_prototypes_through_pioneering_IndieDev_Fund.webp"
                                    alt="3">

                                <div class="textHolder">

                                    <div class="graphicLine"></div>

                                    <div class="title">
                                        <h2> How the IndieDev Fund Is Powering a New Wave of Irish Game Creators</h2>
                                    </div>

                                    <div class="graphicLine2"></div>

                                    <div class="text">

                                        <p>New initiative will support eight Irish developers as they prepare to launch
                                            innovative
                                            game prototypes aimed at international audiences...</p>
                                        <p class="author">- Melanie Boylan</p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </li>
                </div>

                <div class="width-4 newsComp newsComp2">

                    <li>
                        <a href="">
                            <div class="content">
                                <img src="images/05_8_Irish_game_developers_to_launch_game_prototypes_through_pioneering_IndieDev_Fund.webp"
                                    alt="3">

                                <div class="textHolder">

                                    <div class="graphicLine"></div>

                                    <div class="title">
                                        <h2> How the IndieDev Fund Is Powering a New Wave of Irish Game Creators</h2>
                                    </div>

                                    <div class="graphicLine2"></div>

                                    <div class="text">

                                        <p>New initiative will support eight Irish developers as they prepare to launch
                                            innovative
                                            game prototypes aimed at international audiences...</p>
                                        <p class="author">- Melanie Boylan</p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </li>
                </div>

                <div class="width-4 newsComp newsComp2">

                    <li>
                        <a href="">
                            <div class="content">
                                <img src="images/05_8_Irish_game_developers_to_launch_game_prototypes_through_pioneering_IndieDev_Fund.webp"
                                    alt="3">

                                <div class="textHolder">

                                    <div class="graphicLine"></div>

                                    <div class="title">
                                        <h2> How the IndieDev Fund Is Powering a New Wave of Irish Game Creators</h2>
                                    </div>

                                    <div class="graphicLine2"></div>

                                    <div class="text">

                                        <p>New initiative will support eight Irish developers as they prepare to launch
                                            innovative
                                            game prototypes aimed at international audiences...</p>
                                        <p class="author">- Melanie Boylan</p>
                                    </div>
                                </div>

                            </div>
                        </a>
                    </li>
                </div>
            </div>
        </div>

    </div>

</body>

</html>