<!DOCTYPE html>
<html>
    <head>
        <title>Ma page 2 session </title>
        
    </head>

    <body>
    <h1>Page 2 </h1>
    <?php 
       session_start();
       echo "Bienvenue à toi ".$_SESSION['prenom']."<br/>";
       echo "Votre ville est ".$_SESSION['ville'];
      ?>
    </body>
    </html>