<?php

$sections = $sections ?? [];

$isAdmin = $_SESSION['user']['role'] ?? 'user' === 'admin';

?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/bootstrap.min.css">
</head>

<body>

<?php require BASE_PATH . 'app/Components/home/header.php'; ?>

<?php require BASE_PATH . 'app/Components/home/hero.php'; ?>

<?php require BASE_PATH . 'app/Components/home/services.php'; ?>

<?php require BASE_PATH . 'app/Components/home/choose.php'; ?>

<?php require BASE_PATH . 'app/Components/home/footer.php'; ?>

</body>
</html>