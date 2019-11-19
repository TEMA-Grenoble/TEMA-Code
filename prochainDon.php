<!-- Cette page est incluse dans la page d'acceuil "index", elle permet de calculer les dates des prochains dons et d'enregistrer les dates entrées si l'utilisateur possède un compte-->
<!DOCTYPE html>
<html lang=fr dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css"/>
    <title></title>
  </head>
  <body>

    <!--Formulaire prise en compte de la date-->
  <form id="formulairedon" method="post" action="">
    <legend>
      <select required name=myOption>
        <option value="sang">Dernier Don de Sang</option>
        <option value="plasma">Dernier Don de Plasma</option>
        <option value="plaquette">Dernier Don de Plaquette</option>
      </select> 
        <input type="hidden" name="submit"/>
        <input type="date" required name="date">
        <input id="bouton" type="submit" value="Calculer votre prochain don !">
    <legend>
  </form>
  <table>

  <?php
    //Appel les fonctions pour le calcul des dates
  include('calculdon.php');

  if (isset($_POST['submit'])){
    $myOption = $_POST['myOption'];
    $date = date_create($_POST['date']);

      if ($myOption == "sang"){
        echo "<p>Prochain don de Sang :</p><p>".plus56 ($date)."</p>";
         echo "<p>Prochain don de Plasma :</p><p>". plus14 ($date)."</p>";
         echo "<p>Prochain don de Plaquette :</p><p>". plus28 ($date)."</p>";}
      elseif ($myOption == "plasma") {
        echo "<p>Prochain don de Sang :</td><p>".plus14 ($date)."</p>";
        echo "<p>Prochain don de Plasma :</td><p>".plus14 ($date)."</p>";
        echo "<p>Prochain don de Plaquette :</td><p>".plus14 ($date)."</p>";}
      else {
        echo "<p>Prochain don de Sang :</p><p>".plus28 ($date)."</p>";
        echo "<p>Prochain don de Plasma :</p><p>".plus14 ($date)."</p>";
        echo "<p>Prochain don de Plaquette :</p><p>".plus28 ($date)."</p>";}
   }
  ?>
  <form id="formulairedon" method="post" action="">

    <!--champs cachés pour stocker des données nécessaires-->
<input type="text" id="cache" name="op" value="<?php if(isset($_POST['myOption'])){echo $_POST['myOption'];} ?>">
<input type="date" id="cache" name="date" value="<?php if(isset($_POST['date'])){echo $_POST['date'];} ?>">
<br>
<p>Vous voulez sauvegarder vos dates ? Identifiez-vous !</p>
<label for="username" id="texteformulairedon"><b>Adresse Mail</b></label> <br>
<?php

 echo '<input type="email"  placeholder="monmail@efs.fr" name="mail" required value=""';
 if (isset($_POST['mail'])) {
   echo htmlspecialchars ($_POST['mail']);
 }
 echo "/>";
?>
<br>
<label for="mdp" id="texteformulairedon"><b>Mot de Passe</b></label> <br>
<?php
 echo '<input type="password"  placeholder="mot de passe" name="mdp" required value=""';
 if (isset($_POST['mdp'])) {
   echo htmlspecialchars ($_POST['mdp']);
 }
 echo "/>";
?>
<br>
<input id="bouton" type="submit" value="Enregistrer vos dates !"> <br>
</form>

<?php

///////// CONNEXION A LA BASE DE DONNES ////////////////
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

//////////RECUPERE DONNEES DES CHAMPS /////////////////
     //Récupére le mail entré
     if (isset($_POST['mail']) AND isset($_POST['mdp']) AND isset($_POST['op']) AND isset($_POST['date'])) {
        $chercheMail = $_POST['mail'];
        $mdp = $_POST['mdp'];
        $mailTrouve=false;
        $mdpCorrespont=false;
        $op=$_POST['op'];
        $temp=$_POST['date'];
        $date=date_create($_POST['date']);
       //calcul des prochains dons et changement du format des dates pour quelles soient acceptées par la BDD
        $dateplus56= plus56($date);
        $dateplus56= date("Y-m-d",strtotime($dateplus56));
        $dateplus28= plus28($date);
        $dateplus28= date("Y-m-d",strtotime($dateplus28));
        $dateplus14= plus14($date);
        $dateplus14= date("Y-m-d",strtotime($dateplus14));

///////// REQUETE SI MAIL EXISTE DANS BD /////////////
        // Préparation de la requête paramétrable
        $requete = $bdd->prepare("SELECT mail FROM connexion where mail like ?");
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

////////// REQUETE ENREGISTRER DATES /////////////////

if ($mailTrouve and $mdpCorrespont and ($op=="sang")) {

// Préparation de la requête paramétrable
$requete = $bdd->prepare("UPDATE connexion SET dernierdonsang=?, dernierdonplasma=NULL, dernierdonplaquette=NULL, donsang=?, donplasma=?, donplaquette=? WHERE mail=?;");
// Exécution de la requête en remplaçant les '?' présents dans la requête
$requete->execute(array($temp,$dateplus56,$dateplus14,$dateplus28,$chercheMail));}

if ($mailTrouve and $mdpCorrespont and ($op=="plasma")) {
// Préparation de la requête paramétrable
$requete = $bdd->prepare("UPDATE `connexion` SET `dernierdonsang`= NULL,`dernierdonplasma`= ?,`dernierdonplaquette`= NULL,`donsang`= ?,`donplasma`= ?,`donplaquette`=? WHERE `mail`= ?");
// Exécution de la requête en remplaçant les '?' présents dans la requête
$requete->execute(array($temp,$dateplus14,$dateplus14,$dateplus14,$chercheMail));}

elseif ($mailTrouve and $mdpCorrespont and ($op=="plaquette")) {
// Préparation de la requête paramétrable
$requete = $bdd->prepare("UPDATE `connexion` SET `dernierdonsang`= NULL,`dernierdonplasma`= NULL,`dernierdonplaquette`= ?,`donsang`= ?,`donplasma`= ?,`donplaquette`=? WHERE `mail`= ?");
// Exécution de la requête en remplaçant les '?' présents dans la requête
$requete->execute(array($temp,$dateplus28,$dateplus14,$dateplus28,$chercheMail));}}

?>
</table>
  </body>
</html>
