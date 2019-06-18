<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_SESSION['id']) AND $_SESSION['id'] > 0) {
   $getid = intval($_SESSION['id']);
   $requser = $bdd->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
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

              
                <?php
                 if (strcasecmp($userinfo['droit'], 'admin') == 0){


                       echo ' </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="admin.php">Administration</a></span>';
                       
              
                    }
                 ?>
                 <?php
                 }
                 ?>

                  </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span>

             </div>
       </div>
   </nav>
   <div class="profile">
      <div align="center">
         <h2 style="margin:50px;">Profil de <?php echo $userinfo['pseudo']; ?></h2>

          <i class="fa fa-user fa-5x"></i>
          <br /><br />
         Pseudo : <?php echo $userinfo['pseudo']; ?>
         <br />
         Mail : <?php echo $userinfo['mail']; ?>
         <br />
         Droit : <?php echo $userinfo['droit']; ?>
         <br />
         <br />         
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
             <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="editionprofil.php">Editer mon profil</a></span>
         <br />
             <span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="supp_account.php">Supprimer mon compte</a></span>
             <br />

 
      </div>
   </div>
   </body>
</html>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
<?php   
}
?>


