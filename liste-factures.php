<?php
session_start();
if(isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])){
    $id_membre = $_SESSION['id_membre'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Liste des factures</title>
</head>
<body>
<h1>Liste des factures pour vous <?= $_SESSION['pseudo'] ?> </h1>

<?php 
// Etape 0 : Créer la base de données

//Etape 1: Inclusion des paramètres de connexion
include_once('myparam.inc.php');

//Etape 2: Connexion au serveur de base de données MySQL
$idcom = new mysqli(MYHOST, MYUSER, MYPASS, "facturation");

//Etape 3: Test de la connexion
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}

    $requete = " SELECT * FROM facture WHERE id_membre = '$id_membre' ";

    $result = $idcom->query($requete);

    echo "<table border>
        <tr>
        <td>ID de la facture</td>
        <td>Numéro de la facture</td>
        <td>Client</td>
        <td>Date de la facture</td>
        <td>Actions</td>
        </tr>";
    
    
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['num']."</td>
            <td>".$row['client']."</td>
            <td>".$row['datefacture']."</td>
            <td> <a href=\"detail-facture.php?=".$row['id']."\">Details</a></td>
            </tr>";
            //$_SESSION['id_facture'] = $row['id'];
    }

    //$id_facture = $_SESSION['id'];
    //Etape 9 et dernière étape: On ferme la connexion
    $idcom->close();

echo "</table>";


?>

</body>
</html>
<?php
    }
    else {echo "Vous n'êtes pas autorisé à visiter cette page <br/>";
          echo "<a href = \"connexion.php\">Merci de vous connecter</a> ";}
    ?>