<nav>

    <input id="nav-toggle" type="checkbox">
    <div class="logo">
        <?php
        if (session("professionnels")) { ?>
            <a href="<?= base_url()  ?>/prosIndex"><img src="<?= base_url()  ?>/img/garderie.png" alt="logo"></a>
        <?php
        } else { ?>
            <a href="<?= base_url()  ?>/professionnels"><img src="<?= base_url()  ?>/img/garderie.png" alt="logo"></a>
        <?php
        }
        ?>
    </div>

    <ul class="links">
        <li><a href="<?= base_url(); ?>/">Mode utilisateurs</a></li>
        <?php
        if (session("professionnels")) { ?>
            <li><a href="<?= base_url()  ?>/create"><img src="<?= base_url()  ?>/img/create.png" alt="">Créer une annonce</a></li>
            <li><a href="<?= base_url()  ?>/profilPros"><img src="<?= base_url()  ?>/img/profile.png" alt="">Profil</a></li>
            <li class="deconnexion"><img src="<?= base_url()  ?>/img/logout.png" alt=""><a href="<?= base_url() ?>/deconnexionPros">Déconnexion</a></li>
        <?php
        } else { ?>
            <li><a href="<?= base_url(); ?>/inscriptionPros">Inscription</a></li>
            <li><a href="<?= base_url(); ?>/connexionPros">Connexion</a></li>
        <?php
        }
        ?>
    </ul>
    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>



</nav>