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
    <article>  
    <form id="formulaire" method=post action="">
          <section class="login">
            <label for="username"><h1>Adresse Email</h1></label> <br>
            <?php
             echo '<input type="email"  placeholder="monmail@efs.fr" name="mail" required value=""';
             if (isset($_POST['mail'])) {
               echo $_POST['mail'];
             }
             echo "/>";
            ?>
            <br>
            <button id="boutonemail" type="submit">Login</button>
          </section>
        </form>
       <?php
       // Informations de connextion à la BDD
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
       //Récupére le mail entré
       if (isset($_POST['mail'])) {
          $termeRecherche = $_POST['mail'];
          $trouve=false;
          // Préparation de la requête paramétrable
          $requete = $bdd->prepare("SELECT mail FROM connexion");
          // Exécution de la requête en remplaçant le '?' présent dans la requête par le terme recherché
          // (On concatène un '%' à la suite du terme pour que la requête retourne tous les éléments qui commencent par le terme recherché)
          $requete->execute(array($termeRecherche.'%'));
          // Récupération des données retournées par la requête
          $donnees = $requete->fetchAll();
          // Parcours des lignes de données et affichage de chaque élément à la liste
          foreach ($donnees as $ligne) {
              if ($ligne['mail']==$termeRecherche){
                $trouve=true;}}
          //Si un mail correspondant a été trouvé alors
          if ($trouve==true){
            // Préparation de la requête paramétrable : récupére les dates correspondantes au mail
            $requete = $bdd->prepare("SELECT dernierdonsang dernierdonplasma dernierdonplaquette donsang donplasma donplaquette FROM `connexion` WHERE `mail` like ?");
            // Exécution de la requête en remplaçant le '?' présent dans la requête par le mail recherché
            $requete->execute(array($termeRecherche.'%'));
            // Récupération des données retournées par la requête
            $donnees = $requete->fetchAll();
            // Parcours des lignes de données et affichage de chaque élément nécessaire
            foreach ($donnees as $ligne) {
              if ($ligne['dernierdonsang']!=NULL){echo "Votre dernier don de sang : " .$ligne['dernierdonsang'] . '<br>';}
              elseif ($ligne['dernierdonplasma']!=NULL){echo "Votre dernier don de plasma :" .$ligne['dernierdonplasma'] . '<br>';}
              else {echo "Votre dernier don de plaquettes :" .$ligne['dernierdonplaquette'] . '<br>';}
              echo "Prochain Don de sang : " .$ligne['donsang']. '<br>';
              echo "Prochain Don de plaquettes : " .$ligne['don plaquettes']. '<br>';
              echo "Prochain Don de plasma : " .$ligne['donplasma']. '<br>';}
            }
          //Si le mail n'est pas dans la base de données
          else {echo "Votre mail n'est pas enregistré sur notre site.";}
          }
        ?>        
    </article>
    <footer id="footer">
        <main>
            <p class="pfooter">Créé avec ❤️️ à Grenoble, France 🗻</p>
            <p class="pfooter2">T<span class="rouge">E</span>MA est une plateforme développée dans le cadre d'un projet d'école, nous ne sommes en aucun cas affiliés à l'EFS.</p>
            <p class="pfooter">© 2019 T<span class="rouge">E</span>MA. Tous droits réservés.</p>
        </main>
    </footer>
</body>
</html>