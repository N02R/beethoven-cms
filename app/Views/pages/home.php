
<?php

// حماية من عدم وجود المتغير
$sections = $sections ?? [];

// Hero data مع fallback كامل
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

    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/bootstrap.min.css">

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
           HERO SECTION
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
     HERO SECTION
========================= -->
<section class="hero">

    <div>

        <h1 class="editable" contenteditable="false" data-field="title">
            <?= $hero['title'] ?>
        </h1>

        <p class="editable" contenteditable="false" data-field="description">
            <?= $hero['description'] ?>
        </p>

        <a href="#" class="editable" contenteditable="false" data-field="button_text">
            <?= $hero['button_text'] ?>
        </a>

    </div>

</section>

<!-- =========================
     JS EDIT MODE
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

</script>

</body>
</html>