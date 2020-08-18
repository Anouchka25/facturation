<!DOCTYPE html>
<html>
    <head>
        <title>Création de factures </title>
        
    </head>

    <body>
    <h1>Création de factures </h1>

    <?php 
       
       echo "Bienvenue à toi Lucie";
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
    //Inclusion des paramètres de connexion
include_once('myparam.inc.php');

//Connexion au serveur de base de données MySQL
$idcom = new mysqli(MYHOST, MYUSER, MYPASS, "facturation");

//Test de la connexion
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}
//On vérifie que tous les champs du formulaire sont renseignés, si un champs vide on met la variable $formValid à true/
$formValid = false;
foreach ($_POST as $cle => $valeur) {
    if (empty($_POST[$cle])) {
        $formValid = true;
    }
}
if ($formValid) {
    echo "Veuillez remplir tous les champs du formulaire !";
} else {

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
    '$mailclient', '$datefacture', '$facturede', '$designation', 
    '$quantite', '$prixht', '$taxe', '$conditions', 1)";

    $result = $idcom->query($requete);

//On vérifie si la requete a bien été exécuté/recue au niveau du serveur mysql
   if($result){
    echo "Votre facture a bien été enregistrée au numéro :".$idcom->insert_id;
}
else { echo "Erreur ".$idcom->error;}

//On ferme la connexion
$idcom->close();
     }
?>
    
