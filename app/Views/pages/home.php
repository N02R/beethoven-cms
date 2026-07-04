<?php

$sections = $sections ?? [];

$hero = $sections['hero'] ?? [
    'title'       => 'No Title',
    'description' => 'No Description',
    'button_text' => 'Button'
];

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= APP_NAME ?></title>

    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/bootstrap.min.css">

    <style>

        body{
            margin:0;
            background:#0f172a;
            color:#fff;
            font-family:Arial,sans-serif;
        }

        /* ==========================
           CMS Toolbar
        ========================== */

        #cms-toolbar{

            position:fixed;

            top:20px;
            right:20px;

            z-index:99999;

        }

        #editToggle{

            padding:12px 18px;

            border:none;

            border-radius:8px;

            cursor:pointer;

            background:#2563eb;

            color:#fff;

        }

        /* ==========================
           Hero
        ========================== */

        .hero{

            min-height:100vh;

            display:flex;

            justify-content:center;

            align-items:center;

            text-align:center;

            padding:40px;

        }

        .hero h1{

            font-size:48px;

            margin-bottom:20px;

        }

        .hero p{

            font-size:20px;

            margin-bottom:25px;

        }

        .hero a{

            display:inline-block;

            background:#2563eb;

            color:#fff;

            padding:12px 22px;

            border-radius:8px;

            text-decoration:none;

        }

        /* ==========================
           Edit Mode
        ========================== */

        .edit-mode .editable{

            outline:2px dashed #38bdf8;

            cursor:text;

        }

        .editable:focus{

            outline:2px solid #38bdf8;

            background:rgba(56,189,248,.08);

        }

    </style>

</head>

<body>

<div id="cms-toolbar">

    <button id="editToggle">

        ✏️ Edit Mode

    </button>

</div>

<section class="hero">

    <div>

        <h1
            class="editable"
            data-section="hero"
            data-field="title"
            contenteditable="false">

            <?= htmlspecialchars($hero['title']) ?>

        </h1>

        <p
            class="editable"
            data-section="hero"
            data-field="description"
            contenteditable="false">

            <?= htmlspecialchars($hero['description']) ?>

        </p>

        <a
            href="#"
            class="editable"
            data-section="hero"
            data-field="button_text"
            contenteditable="false">

            <?= htmlspecialchars($hero['button_text']) ?>

        </a>

    </div>

</section>