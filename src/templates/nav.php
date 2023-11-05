<?php
$classes = "grow-on-hover";
if (strpos($_SERVER['SCRIPT_NAME'], "/blog/") !== false) {
    $classes .= " navbar-active";
}
?>

<nav>
    <h1 id="hero" class="grow-on-hover"><a href="/">Kosay Jabre</a></h1>
    <ul>
        <li class="grow-on-hover"><a class="<?php echo $classes; ?>" href="/blog">Blog</a></li>
    </ul>
</nav>
