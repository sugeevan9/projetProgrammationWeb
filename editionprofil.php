<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SmartDoc - Profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/profil.css">
</head>
   <body>

   <nav class="navbar navbar-light navbar-expand-md shadow-lg navigation-clean-button" style="background-color: #313437;">
       <div class="container"><a class="navbar-brand" href="#" style="color: #ffffff;">SmartDoc</a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
           <div class="collapse navbar-collapse" id="navcol-1">
               <ul class="nav navbar-nav mr-auto">

                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                           Mon profil
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="profil.php">Afficher mon profil</a>
                           <a class="dropdown-item" href="editionprofil.php">Editer mon profil</a>
                           <a class="dropdown-item" href="supp_account.php">Supprimer mon compte</a>
                       </div>
                   </li>

                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                           Documents
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="document.php">Afficher les documents publiques</a>
                           <a class="dropdown-item" href="mydocument.php">Afficher mes documents</a>
                           <a class="dropdown-item" href="upload.php">Upload un document</a>
                       </div>
                   </li>

                   <li class="nav-item dropdown">
                       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="color: white !important;">
                           Statistiques
                       </a>
                       <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                           <a class="dropdown-item" href="stat_extension.php">Par extension</a>
                           <a class="dropdown-item" href="stat_public.php">Publiques / Privés</a>
                       </div>
                   </li>

               </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span>
              
             </div>
       </div>
   </nav>

   <div align="center">
   <div class="contact">
       <form class="shadow" method="post" style="border-radius: 20px 50px 20px 50px;" action="" enctype="multipart/form-data">
           <h2 class="text-center">Edition de mon profil</h2>
           <div class="form-group"><input class="form-control" type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /></div>
           <div class="form-group"><input class="form-control" type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /></div>
           <div class="form-group"><input class="form-control" type="password" name="newmdp1" placeholder="Mot de passe"/></input></div>
           <div class="form-group"><input class="form-control" type="password" name="newmdp2" placeholder="Confirmation du mot de passe"/></div>
           <div class="form-group"><input class="btn btn-primary btn-block" type="submit"/></input></div>
       </form>
       <?php if(isset($msg)) { echo $msg; } ?>
   </div>
   </div>


   <div class="footer">
       <footer>
           <div class="container">
               <div class="row">
                   <div class="col-md-12 item text">
                       <h3>SmartDoc</h3>
                       <p>Jeune stat-up, SmartDoc souhaite développer sa vison du stockage de document, accessible partout et sur tout support</p>
                   </div>
                  
               </div>
               <p class="copyright">SmartDoc © 2019</p>
           </div>
       </footer>
   </div>
   </body>
</html>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php   
}
else {
   header("Location: connexion.php");
}
?>