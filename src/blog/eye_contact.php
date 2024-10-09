<?php
$metadata = [
    'title' => 'Eye Contact',
    'date' => '31 May, 2020',
    'published' => true
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
                Why do restrooms stalls in North America have such huge gaps in the door?
            </p>
            <p>
                When I worked at the Royal Bank of Canada, the male restroom on my floor had four stalls: three standard stalls and one huge handicapped stall.
                For some reason, without really thinking about it, I would always use the handicapped stall (I am not handicapped).
                It was just more comfortable I guess.
            </p>

            <p>
                One day, I was in the handicapped stall and the outside bathroom door opened.
            </p>
            <p>
                I did not hear any footsteps.
                Instead, it was the creaking of a wheelchair.
                "This cannot be happening", I thought.
                I sunk back.
                Maybe he just wants to wash his hands?
            </p>

            <p>
                He rolled his wheelchair over and tried to open the door to the stall.
                I was too embarrassed to say anything, so I did not.
                He tried to open the door again.
            </p>

            <p>
                "Anybody in there?"

                I dug in and stayed silent.
                I was dying of embarrassment.
                I wanted to disappear.

                Maybe he will think the stall is empty and locked?
                Maybe he will think the stall is out of order?
            </p>

            <p>
                "What the hell?"

                One last attempt to open the door, and then it happened.
                Through the gap in the door, we made eye contact.
            </p>
            <p>
            One excruciating, awkward, shaming, infinitely long, silent second of eye contact.
            </p>
            <p>
                He rolled away and left the bathroom without saying a word.
                But that eye contact said all that needed to be said.
                Needless to say, I never used that restroom again for the entire summer I was there.
            </p>
        </main>
        <?php include "../templates/footer.php"; ?>
    </body>

    </html>
    <?php
}
return $metadata;
?>