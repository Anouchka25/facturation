<?php
session_start();
if(isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])){
    $id_membre = $_SESSION['id_membre'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Création de factures </title>
        
    </head>

    <body>
    <h1>Création de factures </h1>

    <?php 
       
       echo "Bienvenue à toi ".$_SESSION['pseudo'] ;
    ?>
    <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
    <fieldset>
<legend>Créer votre facture</legend>
<table border="0" >
<tr>
<td>Numéro de la facture</td>
<td><input type="text" name="num" /></td> 
</tr>
<tr>
<td>Numéro de la TVA</td>
<td><input type="text" name="numtva" /></td> 
</tr>
<tr>
<td>Client</td>
<td><textarea name="client"></textarea></td> 
</tr>
<tr>
<td>Mail du client</td>
<td><input type="email" name="mailclient" /></td> 
</tr>
<tr>
<td>Date de la facture</td>
<td><input type="date" name="datefacture" /></td> 
</tr>
<tr>
<td>Infos de mon entreprise</td>
<td><textarea name="facturede"></textarea></td> 
</tr>
<tr>
<td>Designation</td>
<td><textarea name="designation"></textarea></td> 
</tr>
<tr>
<td>Quantité</td>
<td><input type="numeric" name="quantite" /></td> 
</tr>
<tr>
<td>Prix HT</td>
<td><input type="numeric" name="prixht" /></td> 
</tr>
<tr>
<td>Taxe</td>
<td><input type="numeric" name="taxe" /></td> 
</tr>
<tr>
<td>Conditions et moyens de paiement</td>
<td><textarea name="conditions"></textarea></td> 
</tr>

<tr >
<td colspan="2">&nbsp;&nbsp;<input type="submit" name="envoi" value="
Envoyer " /></td>
</tr>
</table>
</fieldset>
</form>
    

    </body>
    </html>
    <?php
    }
    else {echo "Vous n'êtes pas autorisé à visiter cette page <br/>";
          echo "<a href = \"connexion.php\">Merci de vous connecter</a> ";}
    ?>
    <?php
    //Inclusion des paramètres de connexion
include_once('myparam.inc.php');

//Connexion au serveur de base de données MySQL
$idcom = new mysqli(MYHOST, MYUSER, MYPASS, "facturation");

//Test de la connexion
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}

if(!empty($_POST['num']) 
&& !empty($_POST['numtva'])
&& !empty($_POST['client'])
&& !empty($_POST['mailclient'])
&& !empty($_POST['datefacture'])
&& !empty($_POST['facturede'])
&& !empty($_POST['designation'])
&& !empty($_POST['quantite'])
&& !empty($_POST['prixht'])
&& !empty($_POST['taxe'])
&& !empty($_POST['conditions'])){

    $num = $idcom->escape_string($_POST['num']);
    $numtva = $idcom->escape_string($_POST['numtva']);
    $client = $idcom->escape_string($_POST['client']);
    $mailclient = $idcom->escape_string($_POST['mailclient']);
    $datefacture = $_POST['datefacture'];
    $facturede = $idcom->escape_string($_POST['facturede']);
    $designation = $idcom->escape_string($_POST['designation']);
    $quantite = $idcom->escape_string($_POST['quantite']);
    $prixht = $idcom->escape_string($_POST['prixht']);
    $taxe = $idcom->escape_string($_POST['taxe']);
    $conditions = $idcom->escape_string($_POST['conditions']);

    $requete = "INSERT INTO facture(num, numtva, client, mailclient, datefacture, facturede, designation, quantite, prixht, taxe, conditions, id_membre) 
    VALUES ('$num', '$numtva', '$client', 
    '$mailclient', $datefacture, '$facturede', '$designation', 
    '$quantite', '$prixht', '$taxe', '$conditions', '$id_membre')";

    $result = $idcom->query($requete);

//On vérifie si la requete a bien été exécuté/recue au niveau du serveur mysql
    if($result){
    echo "Votre facture a bien été enregistrée au numéro :".$idcom->insert_id;
    }
    else { echo "Erreur ".$idcom->error;}

//On ferme la connexion
$idcom->close();
}
else {echo "Veuillez remplir la formulaire"; }
     
?>
    
