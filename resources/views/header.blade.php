<header role="banner">
    <a href="/"><img src="/images/LogoMaths.png" width="50px" height="50px" alt="Logo de l'équipe"/></a>
    <h1>Projet MATHS</h1>
    @isset($login)
        <div class="dropdown" role="navigation">
            <a class="dropbtn" href="profil"><img src="/images/ImageCompte.png" width="50px" height="50px" aria-label="Mon compte" alt="Logo de l'équipe"/></a>
            <!--<button class="dropbtn">Dropdown</button>-->
            <div class="dropdown-content">
                <a href="account">Compte</a>
                <a href="/forum/newsubject">Créer un sujet</a>
                <a href="#">Paramètres</a>
                <a href="signout">Déconnexion</a>
            </div>
        </div>
    @endisset
    @empty($login)
        <a href="signin" class="sign" id="signin">Se connecter</a>
        <a href="signup" class="sign" id="signup">S'inscrire</a>
    @endempty
</header>
