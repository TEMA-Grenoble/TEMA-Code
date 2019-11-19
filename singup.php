<!--Page d'inscription ! Permet à l'utilisateur de créer un compte en rentrant son email et un mot de 
passe de son choix !-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css"/>
    <link rel="icon" type="image/gif" href="ressources/TEMALogo512.png"/>
    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Pacifico" rel="stylesheet">
    <title>TEMA / Connection</title>
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
           <article class="arsing">
        <form id="formulaireco" method="POST" action="">
          <div id="login">
          <h1>Inscription ! Déjà inscrit·e ? Connectez vous <a href="login.php">ici</a> !</h1>
            <label for="username"><b>Adresse Mail : </b></label>
            <?php
             echo '<input type="email"  placeholder="monmail@efs.fr" name="mail" required value=""';
             if (isset($_POST['mail'])) {
               echo htmlspecialchars ($_POST['mail']);
             }
             echo " />";
            ?>
            <br>
            <label for="mdp"><b>Mot de Passe : </b></label>
            <?php
             echo '<input type="password"  placeholder="mot de passe" name="mdp" required value=""';
             if (isset($_POST['mdp'])) {
               echo htmlspecialchars ($_POST['mdp']);
             }
             echo "/>";
            ?>
            <br>
             <label for="mdp"><b>Vérification du Mot de Passe : </b></label>
            <?php
             echo '<input type="password"  placeholder="mot de passe" name="mdpconfirmation" required value=""';
             if (isset($_POST['mdp'])) {
               echo htmlspecialchars ($_POST['mdp']);
             }
             echo "/>";
            ?>
            <br>
            <input id="boutonemail" type="submit" value="Inscription !">
          </div>
        </form>
       <?php
///////// CONNEXION A LA BASE DE DONNES ////////////////
       // Informations de connexion à la BDD
       $servername="";
       $username="";
       $password="";
       $dbname="";
       // Connexion à la BDD
       try{
           $bdd = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8',
               $username, $password);}
       catch(Exception $e) {
           die('Erreur de connexion à la BDD : '.$e->getMessage());}
//////////RECUPERE DONNEES DES CHAMPS /////////////////
       //Récupére le mail et mdp saisis, création booléen pour vérification
       if (isset($_POST['mail']) AND isset($_POST['mdp'])) {
          $chercheMail = $_POST['mail'];
          $mdp = $_POST['mdp'];
          $mailTrouve=false;
          $mdpCorrespont=false;
          $mdpconfirmation=$_POST['mdpconfirmation'];
          $reussit=false;
///////// REQUETE SI MAIL EXISTE
          // Préparation de la requête paramétrable
          $requete = $bdd->prepare("SELECT mail FROM connexion");
          $requete->execute(array($chercheMail));
          // Récupération des données retournées par la requête
          $donnees = $requete->fetchAll();
          // Parcours des lignes de données et affichage de chaque élément à la liste
          foreach ($donnees as $ligne) {
            if ($ligne['mail']==$chercheMail){
              $mailTrouve=true;}}

      if ($mailTrouve==false){
          if ($mdp==$mdpconfirmation){
//////// CREATION NOUVEL UTILISATEUR ///////////
            // Préparation de la requête paramétrable
            $requete = $bdd->prepare("INSERT INTO connexion (mail,mdp) VALUES (?,?)");
            // Exécution de la requête en remplaçant les '?' présents dans la requête
            $requete->execute(array($chercheMail,$mdp));
            $reussit=true;}
          else {echo '<p class="badmail">Les mots de passe ne correspondent pas.</p>';}
          }
          else {echo '<p class="badmail">Le mail existe déjà.</p>';}
        if ($reussit==true){echo '<p class="goodmail">L\'utilisateur '.$chercheMail.' a été créé.</p>';}}

        ?>
        </article>
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
