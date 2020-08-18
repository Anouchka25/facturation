<?php
session_start();
if(isset($_SESSION['pseudo']) && isset($_SESSION['password'])){
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Mon compte </title>
        
    </head>

    <body>
    <h1>Espace client </h1>

    <?php 
       
       echo "Bienvenue à toi ".$_SESSION['pseudo'];
    ?>

    </form>

    </body>
    </html>

    <?php
    }
    else {echo "Vous n'êtes pas autorisé à visiter cette page <br/>";
          echo "<a href = \"connexion.php\">Merci de vous connecter</a> ";}
    ?>
    