<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="shortcut icon" href="<?= BASEURL ?>/assets/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <?php if (isset($styles) && count($styles) > 0) : ?>
        <?php foreach ($styles as $style) : ?>
            <link rel="stylesheet" href="<?= BASEURL ?>/css/<?= $style ?>">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
