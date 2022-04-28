<nav>

    <input id="nav-toggle" type="checkbox">
    <div class="logo">

        <a href="<?= base_url(); ?>/"><img src="<?= base_url()  ?>/img/garderie.png" alt="logo"></a>
    </div>

    <ul class="links">
        <li><a href="<?= base_url(); ?>/professionnels">Mode Business</a></li>
        <?php
        if (session("utilisateurs")) {?>
            <li><a href="<?= base_url(); ?>/showEnfants">Gérer les enfants</a></li>
            <li><a href="<?= base_url()  ?>/profil"><img src="<?= base_url()  ?>/img/profile.png" alt="">Profile</a></li>
            <li class="deconnexion"><img src="<?= base_url()  ?>/img/logout.png" alt=""><a href="">Déconnexion</a></li>
        <?php
        }
        else{?>
            <li><a href="<?= base_url(); ?>/inscription">Inscription</a></li>
            <li><a href="<?= base_url(); ?>/connexion">Connexion</a></li>
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