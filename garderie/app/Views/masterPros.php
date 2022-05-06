<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?= $this->renderSection('css') ?>
    <link href="<?= base_url(); ?>/css/headerPros.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/footerPros.css" rel="stylesheet">


    <title>Baby Garde</title>
</head>











<body>

    <?php include_once('template/headerPros.php') ?>

    <?= $this->renderSection('content') ?>

    <?php include_once('template/footerPros.php') ?>

    <?= $this->renderSection('js') ?>

</body>

</html>