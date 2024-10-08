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
                if (is_array($metadata) && $metadata['published']) {
                    // Replace .php extension with .html in the link
                    $htmlFilename = str_replace('.php', '.html', $filename);
                    echo "<div><a href='/blog/$htmlFilename'>{$metadata['title']} ({$metadata['date']})</a></div>";
                }
            }
        }
        ?>
    </main>
    <?php include "../templates/footer.php"; ?>
</body>

</html>
