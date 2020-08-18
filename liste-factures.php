<!DOCTYPE html>
<html>
<head>
<title>Liste des factures</title>
</head>
<body>
<h1>Liste des factures</h1>

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

    $nom = $idcom->escape_string($_POST['nom']);

    $requete = " SELECT nom, prenom, naissance, ville FROM carnet WHERE nom LIKE '$nom%'";

    $result = $idcom->query($requete);

    echo "<table border>
        <tr>
        <td>Nom</td>
        <td>Prénom</td>
        <td>Date de naissance</td>
        <td>Ville</td>
        </tr>";
    
    
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<tr>
            <td>".$row['nom']."</td>
            <td>".$row['prenom']."</td>
            <td>".$row['naissance']."</td>
            <td>".$row['ville']."</td>
            </tr>";
    }

    //Etape 9 et dernière étape: On ferme la connexion
    $idcom->close();

echo "</table>";


?>

</body>
</html>