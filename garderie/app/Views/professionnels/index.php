<?= $this->extend('masterPros') ?>

<?= $this->section('css') ?>
<!-- Mettre le CSS avec une balise link -->
<link href="<?= base_url(); ?>/css/accueilPro.css" rel="stylesheet">
<link href="<?= base_url(); ?>/css/sec1ProimgAnim.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class=" sec1">


    <div class="sec1-container">

        <div class="sec1-p">
            <h1 class="word"></h1>
            <p>Vous êtes passionnés et vous avez les compétences nécessaires pour le métier de garde d'enfants! vous êtes tombés sur la bonne place</p>
            <button>Postulez par ici !</button>
        </div>

        <div>

            <ul class="slideshow">
                <li> <span></span> </li>
                <li> <span></span></li>
                <li> <span></span></li>
                <li> <span></span></li>

            </ul>
        </div>
    </div>
</div>
</section>

</div>
<section class="sec4">
    <div class="sec4-div">
        <div data-aos="fade-up-right" data-aos-duration="2000" class="sec4-item">
            <img src="<?= base_url()  ?>/img/compet.png" alt=" conf">

            <h3>Avec ou sans éxperience</h3>

            <p>dans notre platforme vous pouvez vous inscrire même si vous n'avez pas d'experience.</p>

        </div>
        <div class="sec4-item" data-aos-duration="2000" data-aos="zoom-in-up">
            <img src="<?= base_url()  ?>/img/envoie-mail.png" alt=" conf">

            <h3>Envoie de mail</h3>

            <p>Afin de vérifier votre compte vous devez nous envoyer une piéce justificatif par mail ou par notre formulaire.</p>

        </div>
        <div class="sec4-item" data-aos-duration="2000" data-aos="fade-up-left">
            <img src="<?= base_url()  ?>/img/search.png" alt=" conf">

            <h3>Cherchez parmi les annonces</h3>

            <p>En tant que professionel vous pouvez chercher et contactez les personnes pour garder leurs enfants.</p>

        </div>

    </div>
</section>
<section class="sec2">
    <title></title>
    <div data-aos="zoom-in-up" data-aos-duration="2000">
        <img src=" <?= base_url()  ?>/img/recrut-logo.png" alt='sec2'>
    </div>
    <div data-aos="zoom-in-up" data-aos-duration="2000">
        <p>Vous avez tous les acquis nécessaires! <br> n'hésitez pas à vous inscrire en tant que professionnel</p>
        <button>Créez votre compte Pro</button>
    </div>
</section>
<section class="sec3 " data-aos="zoom-in-up" data-aos-duration="2000">
    <div class="container">
        <br>
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">

                <div class="item active">
                    <img src="<?= base_url()  ?>/img/bienvenue.jpg" alt="bv" width="460" height="345">
                    <div class="carousel-caption">
                        <h3>Bienvenue</h3>
                        <p>Dans votre site Baby Garde.</p>
                    </div>
                </div>

                <div class="item">
                    <img src="<?= base_url()  ?>/img/inscrivez.jpg" alt=" inscrivez vous.." width="460" height="345">
                    <div class="carousel-caption">
                        <h3>Inscrivez-vous dès maintenant</h3>
                        <p>Rejoignez nous en tant que professionelle ou Particulier.</p>
                    </div>
                </div>

                <div class="item">
                    <img src="<?= base_url()  ?>/img/sc.png" alt="Flower" width="460" height="345">
                    <div class="carousel-caption">
                        <h3>Service client 7/7</h3>
                        <p>Nous sommes toujours à votre disposition si besoin.</p>
                    </div>
                </div>

                <div class="item">

                    <img src="<?= base_url()  ?>/img/confi.jpg" alt=" conf" width="460" height="345">
                    <div class="carousel-caption">
                        <h3>Vos enfants sont entre de bonnes mains.</h3>
                        <p>N'hésitez pas à choisir un sitter pour vos enfants en toute sérénité ?</p>
                    </div>
                </div>

            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</section>

<?php

foreach ($infos as $value) {
    echo 'le ' . $value["date"] . ' de ' . $value["debut"] . 'h - ' . $value["fin"] . 'h || Session de ' . $value["debut_session"] . ' a ' . $value["fin_session"] . '<br>';
    echo $value["nom"] . ' ' . $value["prenom"] . ' - ' . $value["age"] . ' ans - ' . $value["sexe"] . '<br>';
    echo '<hr>';
}
?>
<?= $this->endSection() ?>


<!-------------JS-------------->
<?= $this->section('js') ?>
<script src="<?= base_url()  ?>/js/canvaAnim.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<?= $this->endSection() ?>