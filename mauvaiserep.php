<!-- Page des "mauvaises réponses" 
Quand l'utilisateur entre une réponse dite "mauvaise" qui est automatiquement éléminatoire, on execute ce script
directement dans la page du questionnaire -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>

    <link rel="icon" type="image/gif" href="TEMALogo512.png"/>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Pacifico" rel="stylesheet"> 
    <title>TEMA / Test</title>
<?php
//On crée un tableau définisant les "mauvaises réponses" 
//A chaque réponse éléminatoire on affichera la raison de pourquoi cette question est éliminatoire
$mauvaiseRep = [
    [
        "rep" => "L’âge minimum pour donner son sang est 18 ans.
        La limite d’âge pour donner son sang est de 70 ans révolus. Après 60 ans, le premier don est cependant soumis à l'appréciation d’un médecin de l'EFS.
        Après 65 ans, seul le don de sang est autorisé et après avis du médecin.
        "
    ],
    [
        "rep" => "Vous devez peser plus de 50 kg car ce poids minimum garantit votre sécurité."
    ],
    [
        "rep" => "Par mesure de précaution, le don de sang n’est pas possible actuellement si vous avez reçu une transfusion sanguine ou une greffe. Attention, il ne faut pas confondre transfusion et perfusion."
    ],
    [
        "rep" => "Si vous souffrez d’anémie, vous devez attendre que votre taux d’hémoglobine revienne à la normale pour donner votre sang.
        "
    ],
    [
        "rep" => "Pour éviter tout risque de carence, vous ne pouvez pas donner si vous êtes enceinte. Et vous devez attendre 6 mois après l’accouchement."
    ],
    [
        "rep" => "Il faut attendre 15 jours après la disparition des symptômes pour donner son sang."
    ],
    [
        "rep" => "Le don de sang est possible un jour après un détartrage ou le traitement d’une carie et une semaine après une extraction dentaire."
    ],
    [
        "rep" => "Il faut attendre au moins 4 mois après l’opération ou l’endoscopie pour donner son sang."
    ],
    [
        "rep" => "Pour éviter tout risque d’infection lié à une mauvaise stérilisation du matériel, vous devez attendre 4 mois après un piercing ou un tatouage pour donner votre sang."
    ],
    [
        "rep" => "Pour garantir la sécurité du donneur, le don de sang n’est pas possible quand on a des problèmes cardiaques ou que l’on a été victime d’un AVC."
    ],
    [
        "rep" => "Vous ne pouvez pas donner si vous avez eu une relation sexuelle, même protégée, avec plus d’un partenaire au cours des 4 derniers mois. Cette contre-indication ne s’applique pas aux femmes ayant eu des relations sexuelles uniquement avec des femmes."
    ],
    [
        "rep" => "Tout antécédent d'injection de produits stupéfiants par voie intraveineuse, même remontant à plusieurs années, constitue une contre-indication permanente au don de sang."
    ],
    [
        "rep" => "Selon le cas, vous devez attendre de 4 à 12 mois après le dernier contact sexuel avec ce partenaire."
    ],
    [
        "rep" => "Des délais de 1 à 4 mois sont à respecter au retour de certains pays. Pour plus de précisions, consultez la rubrique dédiée sur le site du Don du Sang."
    ],
];

//On définit la variable $rep, qui prend la valeur de $question ($question est la variable définissant le numéro de la question
//on retrouve sa valeur dans l'url)
$rep = $question;
//Si la valeur de la question est égal à 1 ou 3 ou 12
//$texte prend la valeur d'un caractère vide 
if($question==1 OR $question==3 OR $question==12){
    $texte="";
    //Sinon la variable prend la valeur "POUR L'INSTANT"
}else{
    $texte="POUR L'INSTANT";
}
//Ce test permet de trier la "gravité" des question éléminatoires, en effet une partie ne vous rende pas éligible que 
//pour une durée temporaire
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
        <!-- Affiche le titre de la page, avec en complement la valeur de $texte -->
        <p class="mauvaisereptitre">VOUS NE POUVEZ PAS DONNER VOTRE SANG <?php echo$texte; ?></p>
        <!-- Affiche l'élement du tableau des "mauvaises réponses" à l'emplacement de la question
        (si la "mauvaise réponse" est égale à 3, cela affichera le texte au troisième emplacement) --> 
        <p class="reptexte"><?= $mauvaiseRep[$question-1]["rep"] ?></p> 
        <a id="boutontest" class="aled" href="index.php">Revenir au menu</a>  
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