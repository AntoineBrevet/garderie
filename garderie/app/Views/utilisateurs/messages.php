<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/messages.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <header class="msg-header">Vos Messages</header>
    <div class="msg-content">
        <?php


        foreach ($message as $messages) {
            if ($messages['statut'] == "parent") {
        ?>
                <p class="parentP"><?= $messages['contenu']; ?></p>
            <?php

            } else if ($messages['statut'] == "pro") {
            ?>
                <p class="proP"><?= $messages['contenu']; ?></p>
        <?php

            }
        }

        ?>
    </div>
    <div>
        <form method="POST" action="">
            <section id="messages">
                <textarea name="message"></textarea>

                <input type="submit" name="envoyer">
            </section>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- Mettre le JS avec une balise script -->
<?= $this->endSection() ?>