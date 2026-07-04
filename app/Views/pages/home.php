<?php

$sections = $sections ?? [];

$hero = $sections['hero'] ?? [
    'title' => 'No Title',
    'description' => 'No Description',
    'button_text' => 'Button'
];

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>Beethoven CMS Home</title>

    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/bootstrap.min.css">

    <style>

        body {
            margin: 0;
            background: #0f172a;
            color: #fff;
            font-family: Arial;
        }

        /* =========================
           TOOLBAR
        ========================= */
        #cms-toolbar {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 99999;
        }

        #cms-toolbar button {
            background: #0d6efd;
            color: white;
            border: none;
            padding: 10px 14px;
            border-radius: 8px;
            cursor: pointer;
        }

        /* =========================
           HERO
        ========================= */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px;
        }

        .hero h1 {
            font-size: 42px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .hero a {
            display: inline-block;
            padding: 10px 20px;
            background: #2563eb;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
        }

        /* =========================
           EDIT MODE STYLE
        ========================= */
        .edit-mode .editable {
            outline: 2px dashed #00d4ff;
            cursor: text;
        }

        .editable:focus {
            outline: 2px solid #00d4ff;
            background: rgba(0, 212, 255, 0.05);
        }

    </style>

</head>

<body>

<!-- =========================
     TOOLBAR
========================= -->
<div id="cms-toolbar">
    <button id="editToggle">✏️ Edit Mode</button>
</div>

<!-- =========================
     HERO BLOCK
========================= -->
<section class="hero">

    <div>

        <h1 class="editable"
            data-section="hero"
            data-field="title"
            contenteditable="false">

            <?= $hero['title'] ?>
        </h1>

        <p class="editable"
           data-section="hero"
           data-field="description"
           contenteditable="false">

            <?= $hero['description'] ?>
        </p>

        <a href="#"
           class="editable"
           data-section="hero"
           data-field="button_text"
           contenteditable="false">

            <?= $hero['button_text'] ?>
        </a>

    </div>

</section>

<!-- =========================
     ELEMENTOR ENGINE (CORE)
========================= -->
<script>

let editMode = false;

/* Toggle Edit Mode */
document.getElementById("editToggle").onclick = function () {

    editMode = !editMode;

    document.body.classList.toggle("edit-mode", editMode);

    document.querySelectorAll('.editable').forEach(el => {
        el.setAttribute('contenteditable', editMode);
    });

};

/* CLICK TRACKING (Foundation for Elementor) */
document.querySelectorAll('.editable').forEach(el => {

    el.addEventListener('click', function () {

        if (!editMode) return;

        console.log("ELEMENT SELECTED:", {
            section: this.dataset.section,
            field: this.dataset.field,
            value: this.innerText
        });

    });

});

</script>

</body>
</html>