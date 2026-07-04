<?php
$hero = $sections['hero'] ?? [];
?>

<section class="hero">

    <h1><?= $sections['hero']['title'] ?? 'No Title' ?></h1>

<p><?= $sections['hero']['description'] ?? 'No Description' ?></p>

<a href="#"><?= $sections['hero']['button_text'] ?? 'Button' ?></a>

</section>