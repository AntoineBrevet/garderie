<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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