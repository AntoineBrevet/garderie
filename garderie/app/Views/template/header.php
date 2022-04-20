<nav>

    <input id="nav-toggle" type="checkbox">
    <div class="logo">

        <a href=""><img src="<?= base_url()  ?>/img/garderie.png" alt="logo"></a>
    </div>

    <ul class="links">

        <li><a href=""><img src="<?= base_url()  ?>/img/create.png" alt="">Créer une annonce</a></li>
        <li><a href=""><img src="<?= base_url()  ?>/img/profile.png" alt="">Profile</a></li>
        <li><a href="<?= base_url(); ?>/connexion">Connexion</a></li>
        <li><a href="<?= base_url(); ?>/inscription">Inscription</a></li>
        <li class="deconnexion"><img src="<?= base_url()  ?>/img/logout.png" alt=""><a href="">Déconnexion</a></li>

    </ul>
    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>



</nav>