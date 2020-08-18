<!DOCTYPE html>
<html>
    <head>
        <title>Ma page 1 session </title>
        
    </head>

    <body>
    <h1>Page 1 </h1>
      <?php
      session_start() ;
      $_SESSION['prenom'] = "Anouchka";
      $_SESSION['ville'] = "Yvetot";
      //$prenom = "Anouchka";
       echo "Bienvenue à toi ".$_SESSION['prenom']. " eh oui vous habitez bien à ".$_SESSION['ville'];
      ?>
      <br/>
      <a href="page2.php">Ma page 2 </a>
    </body>
    </html>