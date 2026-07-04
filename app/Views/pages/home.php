<?php
$hero = $sections['hero'] ?? [];
?>

<section class="hero">

    <h1>
        <?= $hero[0]['content'] ?? 'No Title' ?>
    </h1>

    <p>
        <?= $hero[1]['content'] ?? 'No Description' ?>
    </p>

    <a href="#">
        <?= $hero[2]['content'] ?? 'Button' ?>
    </a>

</section>