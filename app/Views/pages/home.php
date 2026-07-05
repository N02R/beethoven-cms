<?php

$sections = $sections ?? [];

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/bootstrap.min.css">
</head>

<body>

<!-- HEADER -->
<?php require BASE_PATH . '/app/Components/home/header.php'; ?>

<!-- HERO -->
<?php require BASE_PATH . '/app/Components/home/hero.php'; ?>

<!-- SERVICES -->
<?php require BASE_PATH . '/app/Components/home/services.php'; ?>

<!-- CHOOSE -->
<?php require BASE_PATH . '/app/Components/home/choose.php'; ?>

<!-- FOOTER -->
<?php require BASE_PATH . '/app/Components/home/footer.php'; ?>

</body>
</html>