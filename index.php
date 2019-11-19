<!-- La page principale : C'est la première page que l'utilisateur voit
Sur cette page est disposé les informations principales du site-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/gif" href="ressources/TEMALogo512.png"/>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Pacifico" rel="stylesheet"> 
    <title>TEMA</title>
</head>
<body>
    <header>
    <nav>
        <ul>
            <li class="nav-home"><a href="index.php">Accueil</a></li>
            <li class="nav-test"><a href="questionnaire.php">Test</a></li>
            <li class="nav-about"><a href="about.html">A Propos</a></li>
            <li class="nav-map"><a href="map.html">Carte</a></li>
            <li class="nav-login"><a href="login.php">Inscription / Connexion</a></li>
        </u>
    </nav>
    </header>
    <section>
    <h1>Sang pour Sang T<span class="rouge">E</span>MA!</h1>
    <p class="soustitre">T<span class="rouge">E</span>MA est une plateforme collaborative qui a pour but d'aider les personnes souhaitant donner leur sang par :</p>
    <ul>
        <li class="soustitretwo">Tester leur égibilité au don du sang (Test)</li>
        <li class="soustitretwo">Trouver où donner leur sang (Carte)</li>
        <li class="soustitretwo">Savoir quand redonner son sang (En dessous)</li>
    </ul>
        <hr>
        <main class="container">
            <article class="card">
                <p>Êtes-vous éligible pour donner votre sang ?</p>
                <a id="boutonindex" href="questionnaire.php">Testez-Vous !</a>
            </article>
            <article class="cardtwo">
                <p>Vous avez déjà donné et vous voulez recommencer ?</p>
                <!-- Permet de mettre le script du prochain don directement sur la page -->
                <?php include("prochainDon.php") ?>
            </article>
        </main>
    </section>
    <footer id="footer">
        <main>
            <p class="pfooter">Créé avec ❤️️ à Grenoble, France 🗻</p>
            <p class="pfooter2">T<span class="rouge">E</span>MA est une plateforme développée dans le cadre d'un projet d'école, nous ne sommes en aucun cas affiliés à l'EFS.</p>
            <p class="pfooter">© 2019 T<span class="rouge">E</span>MA. Tous droits réservés.</p>
        </main>
    </footer>
</body>
</html>