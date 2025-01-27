<?php
$metadata = [
    'title' => 'Point Salad',
    'date' => '26 January, 2025',
    'published' => false
];

if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include "../templates/head.php"; ?>
    </head>

    <body>
        <?php include "../templates/nav.php"; ?>

        <main>
            <?php include "../templates/blog_header.php"; ?>
                <p>
                I recently played a board game called <a href="https://www.alderac.com/wp-content/uploads/2019/04/PS_RuleBook.pdf" target="_blank">Point Salad</a>. 
                In this game, you collect vegetable cards and score cards. There are 6 types of vegetables cards and many different types of score cards.
                The score cards allow you to score points based on the number of vegetables you have in your hand. 
                For example, one score card might give you 1 point for each carrot in your hand. Another might give you 2 points per tomato, but -1 points per lettuce.
                You take turns collecting vegetable and score cards, then at the end of the game you go through each score card and do a bunch of arithmetic to determine your final score.
                This step can be tedious. One time when we were playing, someone jokingly said "Imagine if there's an app that could do this for you".
                Everyone quickly laughed and went back to counting, but I had already started thinking about how such an app might work.
                Over Christmas break, I ended up building this app which I show here.
                </p>
                
                <h2> Preparations </h2>
                <h2> Cropping </h2>
                <h2> Augmentation </h2>
                <h2> Modeling </h2>
                <h2> Segmentation </h2>
                <h2> UI </h2>
                <h2> Putting it all together </h2>

        </main>
        <?php include "../templates/footer.php"; ?>
    </body>

    </html>
    <?php
}
return $metadata;
?>