<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/messages.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
<?php


foreach ($message as $messages){
    if($messages['statut'] == "parent"){
        ?>
        <p class="parentP"><?= $messages['contenu'];?></p>
        <?php

    } else if ($messages['statut'] == "pro"){
        ?>
        <p class="proP"><?= $messages['contenu'];?></p>
        <?php

}
}

?>
<form method="POST" action="">
    <textarea name="message"></textarea>
    <br>
    <input type="submit" name="envoyer">
</form>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>


