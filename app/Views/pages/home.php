<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>

<h1><?= $hero['title_text'] ?? 'No Title' ?></h1>
<p><?= $hero['description'] ?? '' ?></p>

</body>
</html>