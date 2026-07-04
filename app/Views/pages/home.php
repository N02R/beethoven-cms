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
           TOOLBAR
        ========================== */

        #cms-toolbar{
            position:fixed;
            top:20px;
            right:20px;
            z-index:99999;
            display:flex;
            gap:10px;
        }

        #editToggle, #saveBtn{
            padding:12px 18px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            background:#2563eb;
            color:#fff;
        }

        #saveBtn{
            background:#16a34a;
        }

        /* ==========================
           HERO
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
           EDIT MODE
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

<!-- TOOLBAR -->
<div id="cms-toolbar">

    <button id="editToggle">✏️ Edit Mode</button>
    <button id="saveBtn">💾 Save</button>

</div>

<!-- HERO -->
<section class="hero">

    <div>

        <h1 class="editable"
            data-id="1"
            contenteditable="false">

            <?= htmlspecialchars($hero['title']) ?>

        </h1>

        <p class="editable"
           data-id="2"
           contenteditable="false">

            <?= htmlspecialchars($hero['description']) ?>

        </p>

        <a href="#"
           class="editable"
           data-id="3"
           contenteditable="false">

            <?= htmlspecialchars($hero['button_text']) ?>

        </a>

    </div>

</section>

<script>

let editMode = false;

/* ==========================
   TOGGLE EDIT MODE
========================== */

document.getElementById("editToggle").addEventListener("click", function(){

    editMode = !editMode;

    document.body.classList.toggle("edit-mode", editMode);

    document.querySelectorAll(".editable").forEach(el => {
        el.contentEditable = editMode;
    });

    this.textContent = editMode ? "✅ Editing..." : "✏️ Edit Mode";

});


/* ==========================
   SAVE FUNCTION
========================== */

function saveBlock(id, value){

    fetch("<?= APP_URL ?>/admin/api/update-block.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            id: id,
            value: value
        })
    })
    .then(res => res.json())
   .then(data => {
    
    console.log("Saved ✔", data);
    
    // 👇 عرض النتيجة داخل الصفحة
    let box = document.getElementById("debugBox");
    
    if (!box) {
        box = document.createElement("div");
        box.id = "debugBox";
        box.style.position = "fixed";
        box.style.bottom = "20px";
        box.style.left = "20px";
        box.style.background = "#000";
        box.style.color = "#0f0";
        box.style.padding = "10px";
        box.style.zIndex = "99999";
        box.style.fontSize = "12px";
        document.body.appendChild(box);
    }
    
    box.innerHTML = JSON.stringify(data, null, 2);
    
})
    .catch(err => {
        console.error("Save Error ❌", err);
    });

}


/* ==========================
   AUTO SAVE ON INPUT
========================== */

document.querySelectorAll(".editable").forEach(el => {

    el.addEventListener("input", function(){

        if(!editMode) return;

        saveBlock(
            this.dataset.id,
            this.innerText
        );

    });

});


/* ==========================
   MANUAL SAVE BUTTON
========================== */

document.getElementById("saveBtn").addEventListener("click", function(){

    document.querySelectorAll(".editable").forEach(el => {

        saveBlock(
            el.dataset.id,
            el.innerText
        );

    });

    alert("Saved ✔");

});

</script>

</body>
</html>