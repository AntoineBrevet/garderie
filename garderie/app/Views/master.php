<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= base_url(); ?>/css/header.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/css/footer.css" rel="stylesheet">
    <?= $this->renderSection('css') ?>
    <title>Baby Garde</title>
</head>

<body>

    <?php include_once('template/header.php') ?>
    <div class="container-fluid text-center contenu">
        <?= $this->renderSection('content') ?>
    </div>

    <?php include_once('template/footer.php') ?>

    <?= $this->renderSection('js') ?>

</body>

</html>
