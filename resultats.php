<!--La page des résultats : Celle ci sert à afficher le résultat du questionnaire (positif ou "neutre")-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/gif" href="TEMALogo512.png"/>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Pacifico" rel="stylesheet"> 
    <title>TEMA / Test</title>
</head>
<body> 
<?php
//On définit une variable titre qui nous servira plus tard et ayant la valeur "false"
$titre = false;
//On définit la valeur du texte de base
$reponse = "Suite à vos réponses vous êtes éligible pour pouvoir donner votre sang !";
//On ouvre la session
session_start();
//Si la variable $_SESSION['jsp'] existe, vérifier sa valeur, si elle est égale à "(EN THÉORIE)" changer le texte de la page 
    //Nb : Si $_SESSION['jsp'] == "(EN THÉORIE)" cela veut dire que l'utilisateur a à un moment saisi la réponse "Je ne sais pas"
    //On règle aussi la valeur de $titre à true
    if(isset($_SESSION['jsp'])){
        if($_SESSION['jsp'] == "(EN THÉORIE)"){
            $reponse = 'Vous avez répondu <b><i>"Je ne sais pas"</i></b> à certaines questions. Vous êtes en théorie éligible mais pensez à faire des tests supplémentaires pour en être certain ! <br>';
        $titre = true;
        }
        else{
            $reponse = "Suite à vos réponses vous êtes éligible pour pouvoir donner votre sang !";
        }
    }
    //Sinon on définit la variable prenant une valeur vide (en réalité elle est de type char mais ne contien pas de caractères)
    else{
        $_SESSION['jsp'] = "";
    }
?>
    <nav>
    <ul>
        <li class="nav-home"><a href="index.php">Accueil</a></li>
        <li class="nav-test"><a href="questionnaire.php">Test</a></li>
        <li class="nav-about"><a href="about.html">A Propos</a></li>
        <li class="nav-map"><a href="map.html">Carte</a></li>
        <li class="nav-login"><a href="login.php">Inscription / Connexion</a></li>
    </ul>
    </nav>     
    <section> 
    <!-- Deux if permettant de controler la valeur de $titre
    Si elle est égale à true cela veut dire que l'utilisateur à répondu "Je ne sais pas à l'une des questions" 
    Le titre aura un style différant (il sera de couleur orange) -->
    <?php if($titre == true): ?>
    <p class="moyennerep">VOUS POUVEZ <?php echo $_SESSION['jsp']; ?> DONNER VOTRE SANG</p>
    <?php endif; ?>
    <!-- Sinon le titre sera vert, indiquant que l'utilisateur à répondu "correctement" 
    |NB| : On remarque que dans le titre est imbriqué la valeur de $_SESSION['jsp'] qui est égale à "EN THÉORIE" dans le premier cas,
    ou à un caractère vide dans l'autre-->
    <?php if($titre == false): ?>
    <p class="bonnerep">VOUS POUVEZ <?php echo $_SESSION['jsp']; ?> DONNER VOTRE SANG</p>
    <?php endif; ?>
    <!-- Affiche la valeur $reponse qui varie celon ce que l'utilisateur à remplit -->
    <p class="reptexte"><?php echo $reponse; ?><br> 
    Regardez où sont les centres les plus proche de chez vous (Grenoble uniquement) en cliquant <a href="map.html">ici</a></p>
    <a id="boutontest" class="aled" href="index.php">Revenir au menu</a> 
    </section>
    <footer id="footer">
        <main>
            <p class="pfooter">Créé avec ❤️️ à Grenoble, France 🗻</p>
            <p class="pfooter2">T<span class="rouge">E</span>MA est une plateforme développée dans le cadre d'un projet d'école, nous ne sommes en aucun cas affiliés à l'EFS.</p>
            <p class="pfooter">© 2019 T<span class="rouge">E</span>MA. Tous droits réservés.</p>
        </main>
    </footer>
    <!-- Permet de "remmettre à zéro la valeur de $_SESSION['jsp'] pour éviter des erreurs"
    <?php 
        $_SESSION['jsp'] = "";
    ?>
</body>
</html>