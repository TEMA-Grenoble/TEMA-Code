<!--La page de connexion !
Elle permet à l'utilisateur de s'identifier : En rentrant son email ainsi que son mot de passe il peut 
voir les dates qu'il a enregistré. -->
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
           <article>  
        <form id="formulaireco" method="POST" action="">
          <div id="login">
          <h1>Vous n'avez pas de compte ? <a href="singup.php">S'inscrire !</a></h1>
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
            <input id="boutonemail" type="submit" value="Connexion !">
              
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
       //Récupére le mail entré
       if (isset($_POST['mail']) AND isset($_POST['mdp'])) {
          $chercheMail = $_POST['mail'];
          $mdp = $_POST['mdp'];
          $mailTrouve=false;
          $mdpCorrespont=false;
///////// REQUETE SI MAIL EXISTE DANS BD /////////////
          // Préparation de la requête paramétrable
          $requete = $bdd->prepare("SELECT mail FROM connexion");
          // Exécution de la requête en remplaçant le '?' présent dans la requête par le terme recherché
          // (On concatène un '%' à la suite du terme pour que la requête retourne tous les éléments qui commencent par le terme recherché)
          $requete->execute(array($chercheMail));
          // Récupération des données retournées par la requête
          $donnees = $requete->fetchAll();
          // Parcours des lignes de données et affichage de chaque élément à la liste
          foreach ($donnees as $ligne) {
              if ($ligne['mail']==$chercheMail){
                $mailTrouve=true;}}
//////// REQUETE SI MDP CORRESPONT A MAIL ///////////
          // Préparation de la requête paramétrable
          $requete = $bdd->prepare("SELECT mdp FROM connexion WHERE mail like ?");
          // Exécution de la requête en remplaçant le '?' présent dans la requête par le mail recherché
          $requete->execute(array($chercheMail));
          // Récupération des données retournées par la requête
          $donnees = $requete->fetchAll();
          // Parcours des lignes de données et affichage de chaque élément à la liste
          foreach ($donnees as $ligne) {
              if ($ligne['mdp']==$mdp){
                $mdpCorrespont=true;}
                else {echo "L'adresse existe, mais le mot de passe est faux.";}}
///////////REQUETE POUR REDONNER DERNIERE DATE /////////////////////
          if ($mailTrouve==true and $mdpCorrespont==true){
            // Préparation de la requête paramétrable : récupére les dates correspondantes au mail
            $requete = $bdd->prepare("SELECT `dernierdonsang`,`dernierdonplasma`,`dernierdonplaquette`,`donsang`,`donplasma`,`donplaquette` FROM connexion WHERE mail like ?");
            // Exécution de la requête en remplaçant le '?' présent dans la requête par le mail recherché
            $requete->execute(array($chercheMail));
            // Récupération des données retournées par la requête
            $donnees = $requete->fetchAll();
            // Parcours des lignes de données et affichage de chaque élément nécessaire
            foreach ($donnees as $ligne) {
              if ($ligne['dernierdonsang']!=NULL){echo "<p>Votre dernier don de sang : </p>" .$ligne['dernierdonsang'] . '<br>';}
              elseif ($ligne['dernierdonplasma']!=NULL){echo "<p>Votre dernier don de plasma :</p>" .$ligne['dernierdonplasma'] . '<br>';}
              else {echo "<p>Votre dernier don de plaquettes :</p>" .$ligne['dernierdonplaquette'] . '<br>';}
              echo "<p>Prochain Don de sang : </p>" .$ligne['donsang']. '<br>';
              echo "<p>Prochain Don de plaquettes : </p>" .$ligne['donplaquette']. '<br>';
              echo "<p>Prochain Don de plasma : </p>" .$ligne['donplasma']. '<br id="margebas">';}
            }
          //Si le mail n'est pas dans la base de données
          elseif ($mailTrouve==false){echo "Votre mail n'est pas enregistré sur notre site.";}
          }
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
