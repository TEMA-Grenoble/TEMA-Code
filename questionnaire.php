<!--La page du questionnaire :
Celle ci affiche le questionnaire permetant de savoir si l'on peut donner son sang ou non -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="article.css"/>
    <link rel="stylesheet" href="body.css"/>
    <link rel="stylesheet" href="footer.css"/>
    <link rel="stylesheet" href="nav.css"/>
    <link rel="icon" type="image/gif" href="TEMALogo512.png"/>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Pacifico" rel="stylesheet"> 
    <title>TEMA / Test</title>
<?php
//On ouvre la session, permetant de stocker des variables pouvant passer d'un script à l'autre et gardant leurs valeurs jusqu'a que 
//l'utilisateur ferme son navigateur
session_start();
//On défini nos question dans un tableau
$questions = [
    [
            "question" => "Avez-vous entre 18 et 70 ans ?", //La question
            "badAnswer" => "non" //La mauvaise réponse : Si l'utilisateur répond "non" sa réponse sera concidéré comme "mauvaise"
    ],
    [
            "question" => "Pesez-vous plus de 50 kg ?",
            "badAnswer" => "non"
    ],
    [
            "question" => "Avez-vous déjà eu une transfusion de sang 
            (globules rouges, plaquettes ou plasma) ou une greffe d’organe ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous une anémie ou un manque de fer ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Êtes-vous enceinte ou avez-vous accouché depuis moins de 6 mois ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous ou avez-vous eu de la fièvre ou une infection 
            (toux, diarrhée, infection urinaire, plaie cutanée…) dans les 2 dernières semaines ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous eu des soins dentaires depuis moins de 24 heures 
            (carie, détartrage), un traitement de racine ou une extraction dentaire depuis moins d’une semaine ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous été opéré·e ou subi une endoscopie (fibroscopie gastrique, coloscopie…) dans les 4 derniers mois ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous eu un piercing (boucle d’oreille compris) ou un tatouage dans les 4 derniers mois ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous eu récemment des douleurs cardiaques après un effort ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous eu plus d’un partenaire sexuel dans les 4 derniers mois ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous déjà pris des drogues par voie intraveineuse ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous connaissance de pratiques à risques chez votre partenaire
            (multipartenaires, drogues par voie intraveineuse) ?",
            "badAnswer" => "oui"
    ],
    [
            "question" => "Avez-vous voyagé dans les 4 derniers mois ?",
            "badAnswer" => "oui"
    ],
];
//On règle la variable de la première question à 1, c'est grace à elle qu'on pourra parcourir notre tableau
$question = 1;
if (isset($_GET['question'])) {
    //Si la question existe on la règle à sa valeur dans l'url (si question = 7 alors $question = 7)
    $question = intval($_GET['question']);
}

if ($question > count($questions)) {
    //Si la variable est supérieure au nombre de questions on redirige l'utilisateur vers la page du résultat
    header("Location: resultats.php");
    die(); //La fonction die() permet de stopper le script
}

// On vérifie qu'on est pas en dehors du tableau 
//(par exemple si l'utilisateur rentre dans l'url question=0 cela le redirigera vers la première question)
if ($question < 1) {
    header('Location: ?question=1');
    die();
}

// On vérifie la methode de la requete pour garentir que le script fonctionne correctement
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    //permet de faire en sorte que l'utilisateur ne puisse pas passer à la question suivante si il ne coche aucune case
    if (!isset($_POST["rep"])) {
        header("Location: ?question=" . $question);
        die();
    }
    // Si la réponse est "mauvaise" on l'envoie sur la page des "mauvaises" réponses 
    if ($_POST["rep"] === $questions[$question-1]["badAnswer"]) {
        include("mauvaiserep.php");
        die();
    }
    //Si la réponse choisie est "Je ne sais pas" on défini une variable de session prenant la valeur de "(EN THÉORIE)"
    if ($_POST["rep"] == "jsp") {
        $_SESSION['jsp'] = "(EN THÉORIE)";
    }

    // Permet de passer à la question suivante
    $question += 1;
    header("Location: ?question=" . $question);
    die();

}
?>

</head>
<body> 
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
    <form id="question" action="" method="POST">
        <p><?= $questions[$question-1]["question"] ?></p> <!--Affiche la question actuelle 
        (si $question=6 affiche la question étant en 6ème posisiton dans le tableau-->
        <div id="radio">
            <label>Oui
                <input type="radio" name="rep" value="oui">
            </label>
            <label>Non
                <input type="radio" name="rep" value="non">
            </label>
            <!-- Si on est à la question 4 ou 13 afficher une option supplémentaire (je ne sais pas) -->
            <?php if($question==4 OR $question==13): ?>
            <label>Je ne sais pas
                <input type="radio" name="rep" value="jsp">
            </label>
            <?php endif; ?>
        </div>   
            <input id="bouton" type="submit" value="Question suivante">
    </form>       
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