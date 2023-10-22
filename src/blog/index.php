<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "../templates/head.php"; ?>
</head>

<body>
    <?php include "../templates/nav.php"; ?>
    <main>

        <?php
        foreach (glob("*.php") as $filename) {
            if ($filename != 'index.php') {
                $metadata = include $filename;
                if (is_array($metadata)) {
                    echo "<a href='/blog/$filename'>{$metadata['title']} ({$metadata['date']})</a>";
                }
            }
        }
        ?>
    </main>
    <?php include "../templates/footer.php"; ?>
</body>

</html>