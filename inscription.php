
<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_POST['forminscription'])) {
   $pseudo = htmlspecialchars($_POST['pseudo']);
   $mail = htmlspecialchars($_POST['mail']);
   $mail2 = htmlspecialchars($_POST['mail2']);
   $mdp = sha1($_POST['mdp']);
   $mdp2 = sha1($_POST['mdp2']);
   $droit = "aucun";
   if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2'])) {
      $pseudolength = strlen($pseudo);
      if($pseudolength <= 255) {
         if($mail == $mail2) {
            if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqpseudo = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ?");
               $reqpseudo->execute(array($pseudo));
               $pseudoexist = $reqpseudo->rowCount();
               if($pseudoexist == 0) {
                  if($mdp == $mdp2) {
                     $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo, mail, motdepasse,droit) VALUES(?, ?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp, $droit));
                     $erreur = "Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
					 
                  } else {
                     $erreur = "Vos mots de passes ne correspondent pas !";
                  }
               } else {
                  $erreur = "Pseudo déjà utilisée !";
               }
            } else {
               $erreur = "Votre adresse mail n'est pas valide !";
            }
         } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
         }
      } else {
         $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Connexion eLibrary</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cabin:700">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/login.css">

</head>

<body id="page-top">

<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a href="https://www.edf.fr"><img src="assets/img/logo.png" width="50" alt="logo"></a></li>
    <li class="nav-item">
        <a class="nav-link" href="index.html">Accueil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="informations.php">Informations</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="Aides.php">Aides</a>
    </li>
</ul>
<div class="login">
    <form method="POST" style="margin-top:-50px" action="">
        <h1>eLibrary</h1>
        <img src="assets/img/logo.png" style="margin-left:center" alt="logo edf"><br/>
        <h2 class="sr-only">Connexion</h2>


        <div class="form-group">


            <input class="form-control" type="text" placeholder="Votre Pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />


        </div>

        <div class="form-group">



            <input class="form-control"  type="email" placeholder="Votre Mail" id="mail" name="mail" value="<?php if(isset($mail)) { echo $mail; } ?>" />

        </div>

        <div class="form-group">

            <input class="form-control" type="email" placeholder="Confirmez votre mail" id="mail2" name="mail2" value="<?php if(isset($mail2)) { echo $mail2; } ?>" />

        </div>

        <div class="form-group">
            <input class="form-control" type="password" placeholder="Votre Mot de Passe" id="mdp" name="mdp" />

        </div>

        <div class="form-group">
            <input class="form-control" type="password" placeholder="Confirmez votre mot de passe" id="mdp2" name="mdp2" />


        </div>


        <div class="form-group">

            <button class="btn btn-primary btn-block" type="submit" name="forminscription">Inscription</button>

        </div>

        <?php
        if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
        }
        ?>

    </form>

</div>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>


            <?php
            if(isset($erreur)) {
               echo '<font color="red">'.$erreur."</font>";
            }
            ?>
         </div>
   </body>
</html>
