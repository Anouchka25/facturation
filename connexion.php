<!DOCTYPE html>
<html>
    <head>
        <title>Connexion </title>
        
    </head>

    <body>
    <h1>Connexion </h1>

    <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
        <input type="text" name="pseudo" placeholder="Votre pseudo">
        <input type="text" name="password" placeholder="Votre mot de passe">
        <input type="submit" value="Connexion">
    </form>
    <?php
    $ps = "lucie25";
    $pass = "toto";
    $id_membre = 1;
    
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
        if($_POST['pseudo'] == $ps && $_POST['password'] == $pass){
        //on devrait faire un select et vérifier que les données saisies correspondent 
        // à celles qui sont dans la base de données 
        session_start(); //on créé une session
        $_SESSION['pseudo'] = $ps;
        $_SESSION['password'] = $pass;
        $_SESSION['id_membre'] = $id_membre;

        header('Location: create-facture.php'); //Une fois connecté, on redirige l'utilisateur vers son espace client
    }
    }
    else{ echo "Veuillez vous connecter"; }
       
    ?>
    </body>
    </html>