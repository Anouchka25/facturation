<?php
session_start();
if(isset($_SESSION['pseudo']) && isset($_SESSION['id_membre'])){
    $id_membre = $_SESSION['id_membre'];

?>
<!DOCTYPE html>
<html>
<head>
<title>Détails d'une facture</title>
</head>
<body>
<h1>Détails d'une facture <?= $_SESSION['pseudo']  ?> </h1>

<?php 
//Etape 1: Inclusion des paramètres de connexion
include_once('myparam.inc.php');

//Etape 2: Connexion au serveur de base de données MySQL
$idcom = new mysqli(MYHOST, MYUSER, MYPASS, "facturation");

//Etape 3: Test de la connexion
if(!$idcom){
    echo "Connexion impossible";
    exit(); //On arrete tout, on sort du script
}

if(isset($_GET['id'])){
    $id_facture = array($_GET['id']);
    //echo $_GET['id'];

    $requete = "SELECT * FROM facture WHERE id = $id_facture ";

    $result = $idcom->query($requete);

    echo "<table border>";
    
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
            echo "<tr>
            <td>Numéro de la facture</td>
            <td>".$row['num']."</td>
            </tr>
            <tr>
            <td>Numéro de la TVA</td>
            <td>".$row['numtva']."</td>
            </tr>
            <tr>
            <td>Client</td>
            <td>".$row['client']."</td>
            </tr>
            <tr>
            <td>Mail du client</td>
            <td>".$row['mailclient']."</td>
            </tr>
            <tr>
            <td>Date de la facture</td>
            <td>".$row['datefacture']."</td>
            </tr>
            <tr>
            <td>Infos de mon entreprise</td>
            <td>".$row['facturede']."</td>
            </tr>
            <tr>
            <td>Designation</td>
            <td>Quantité</td>
            <td>Prix HT</td>
            <td>Taxe</td>
            </tr>
            <tr>
            <td>".$row['designation']."</td>
            <td>".$row['quantite']."</td>
            <td>".$row['prixht']."</td>
            <td>".$row['taxe']."</td>
            </tr>
            
            ";
    }

    //Etape 9 et dernière étape: On ferme la connexion
    $idcom->close();

echo "</table>";

}
?>

</body>
</html>
<?php
    }
    else {echo "Vous n'êtes pas autorisé à visiter cette page <br/>";
          echo "<a href = \"connexion.php\">Merci de vous connecter</a> ";}
    ?>