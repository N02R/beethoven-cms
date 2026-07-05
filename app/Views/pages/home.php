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

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
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

        #editToggle,
        #saveBtn{
            padding:12px 18px;
            border:none;
            border-radius:8px;
            cursor:pointer;
            color:#fff;
            font-size:14px;
        }

        #editToggle{
            background:#2563eb;
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
            opacity:.9;
        }

        .hero a{
            display:inline-block;
            padding:12px 22px;
            background:#2563eb;
            color:#fff;
            text-decoration:none;
            border-radius:8px;
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

<!-- SCRIPT -->
<script>

let editMode = false;

/* ==========================
   EDIT MODE TOGGLE
========================== */

document.getElementById("editToggle").addEventListener("click", function(){

    editMode = !editMode;

    document.body.classList.toggle("edit-mode", editMode);

    document.querySelectorAll(".editable").forEach(el => {
        el.contentEditable = editMode;
    });

    this.textContent = editMode
        ? "✅ Editing..."
        : "✏️ Edit Mode";

});


/* ==========================
   SAVE BUTTON (ONLY UI TEST)
========================== */

document.getElementById("saveBtn").addEventListener("click", function() {
    
    let data = [];
    
    document.querySelectorAll(".editable").forEach(el => {
        
        data.push({
            id: el.dataset.id,
            value: el.innerText
        });
        
    });
    
    fetch(window.location.origin + "/admin/api/update-block.php", {
            
            method: "POST",
            
            headers: {
                "Content-Type": "application/json"
            },
            
            body: JSON.stringify({
                blocks: data
            })
            
        })
        .then(res => res.json())
        .then(res => {
            
            alert("Server Response: " + JSON.stringify(res));
            console.log(res);
            
        })
        .catch(err => {
            
            alert("Error sending data");
            console.log(err);
            
        });
    
});

</script>

</body>
</html>