<?php

$hero = $sections['hero'] ?? [];

$title = $hero['title'] ?? 'No Title';
$description = $hero['description'] ?? 'No Description';
$button = $hero['button_text'] ?? 'Button';

?>

<section class="hero py-5">

    <div class="hero-content">

        <h1 class="editable" data-id="hero_title">
            <?= htmlspecialchars($title) ?>
        </h1>

        <p class="editable" data-id="hero_description">
            <?= htmlspecialchars($description) ?>
        </p>

        <a href="#" class="editable" data-id="hero_button">
            <?= htmlspecialchars($button) ?>
        </a>

    </div>

</section>