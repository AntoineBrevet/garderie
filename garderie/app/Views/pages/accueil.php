
<?= $this->extend('master') ?>

<?= $this->section('css') ?>
<link href="<?= base_url(); ?>/css/accueil.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="sec1">
    <div class="sec1-container">

        <div>
            <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">

            <svg>
                <text x="50%" y="20%" dy=".35em" text-anchor="middle">
                    Baby Garde
                </text>


            </svg>

        </div>
        <div class="sec1-p">
            <p>une plateforme hyper complète et très fonctionnelle qui permet aux parents <br> de géolocaliser la baby-sitter la plus proche de leur domicile.</p>
        </div>
    </div>
</section>
<section class="sec2">

    <div>
        <img src="<?= base_url()  ?>/img/sec2.png" alt='sec2'>
    </div>
    <div>
        <p>Découvrez notre site et tout nos services dans le site <br>Une équipe à votre disposition 7/7</p>
        <button>Contactez Nous</button>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('js') ?>

<?= $this->endSection() ?>