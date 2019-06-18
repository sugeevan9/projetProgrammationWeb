<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', ''); //connexion à la BDD

if(isset($_POST['formconnexion'])) {

   if (isset($_POST['pseudoconnect'])) { 
      $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']); 
    }
   
   if (isset($_POST['mdpconnect'])) { 
      $mdpconnect = sha1($_POST['mdpconnect']);
    }



   if(!empty($pseudoconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND motdepasse = ?");
      $requser->execute(array($pseudoconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['pseudo'] = $userinfo['pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         $_SESSION['droit'] = $userinfo['droit'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";

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
    <link rel="stylesheet" href="assets/css/scroll.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
</head>

<body id="page-top">

        <nav class="navbar navbar-light navbar-expand-md shadow-lg navigation-clean-button" style="background-color: #313437;">
            <div class="container"><a class="navbar-brand" href="#" style="color: #ffffff;">SmartDoc</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div
                        class="collapse navbar-collapse" id="navcol-1">
                    <ul class="nav navbar-nav mr-auto">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="connexion.php" style="color: #ffffff;">Accueil</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="accueil_membre.php" style="color: #ffffff;">Vos documents</a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" href="aides.php" style="color: #ffffff;">Aides</a></li>



                     <?php
                          if(isset($_SESSION['id'])) {

                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Vous êtes connectez : Déconnexion</a>';
                               
                      
                            } else {


                               echo '</ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="connexion.php">Connectez-vous</a>';
                            }
                         ?>
                     
                    </span></div>
            </div>
        </nav>


    <div class="login">
        <form method="POST" style="margin-top:-100px" action=""> 
            <h1>eLibrary</h1>
            <img src="assets/img/logo.png" alt="logo edf"><br/>
            <h2 class="sr-only">Connexion</h2>

            <div class="form-group">
            
              <input class="form-control" name="pseudoconnect" placeholder="Pseudo">
            
            </div>
            
            <div class="form-group">
            
              <input class="form-control" type="password" name="mdpconnect" placeholder="Mot de passe">
            
            </div>
            
            <div class="form-group">
            
                <button class="btn btn-primary btn-block" type="submit" name="formconnexion">Connexion</button>
            
            </div>
            
            <?php
              if(isset($erreur)) {
              echo '<font color="red">'.$erreur."</font>";
              }
            ?>
<!--         <a href="Aides.php" class="new_member">Demander un accès</a> --> 
			      <a href="inscription.php" class="new_member">Crée un compte</a>
            <a href="Aides.php" class="new_member"><i class="fa fa-question-circle-o" style="font-size: 25px;"></i></a>
        </form>

    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
