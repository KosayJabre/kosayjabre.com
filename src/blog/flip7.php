<?php
$metadata = [
    'title' => 'Flip7',
    'date' => '6 April, 2026',
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
                I'm visiting some friends and family in Germany and we've been playing a lot of Flip7 (a push-your-luck card game similar to Blackjack). 
                <br>
                After losing too many times I decided to do what any reasonable person would do: build a computer program that plays the game optimally and use it to <s>utterly dominate my enemies</s> beat my friends.  
                <br>
                I ended up using a technique called reinforcement learning to train an artificial neural network (which we named "Alfred") to play the game, and it ended up being pretty good!
                It was pretty fun to build and I thought I'd share the process in this blog post. It went roughly something like this:
                <ul>
                    <li>Build a digital version of the game.</li>
                    <li>Build an "expected value" solver for the game.</li>
                    <li>Use reinforcement learning to train a neural network that approximates the solver.</li>
                </ul>
                </p>

                <h3> Game Rules </h3>
                <p>
                    It's a fairly simple game. The full rules can be found <a href="https://cdn.shopify.com/s/files/1/0611/3958/3198/files/25_FLIP_7_TB_RULES_C_Rev_9_2_25_ND.pdf?v=1756935535">here</a>. 
                    The gist of it is that you need 200 points to win, and you score points across multiple rounds.
                    In each round, you can "hit" to draw a random card and put it infront of you or "stay" to convert the number value of the cards you have infront of you into points.
                    Here's the catch: if you hit and draw a duplicate card that you already have infront of you, you "bust" and score 0 points for that round.
                    It's also played with a special deck of cards. Cards appear in the deck as many times as their number of value (ie. there are 12 twelves, 11 elevens, 10 tens, etc.).
                    There are a few other things (modifier cards like x2 that double your score for that round and action cards like "Flip 3 in a row" that can be played on yourself or other players) but that's pretty much it. 
                </p>

                <h3> Solving the Game </h3>
                <p>
                </p>

                <h3> Reinforcement Learning </h3>
                <p>
                </p>

        </main>
        <?php include "../templates/footer.php"; ?>
    </body>

    </html>
    <?php
}
return $metadata;
?>