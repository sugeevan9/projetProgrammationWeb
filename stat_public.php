
<?php
    session_start();
    require 'includes/connect_db.php';
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
    /*  var_dump($_FILES); */



    if(!isset($_SESSION['id'])) {

            echo "Aucun utilisateur connecter ";
            echo '<a href="connexion.php">Connecter vous !</a>';


            exit;

    }



//    $extension_autorisees = array('.pdf', '.PDF','.doc','.DOC','.docx','.DOCX');

/*    $user_a_modiff = $_POST['supp_user'];
       /     echo "La personne '$user_a_modiff'"; 
            $reqid = $bdd->prepare("SELECT id FROM membres WHERE pseudo = ?");
            $reqid->execute(array($user_a_modiff));
            $user_id = $reqid->fetch();
           echo "La personne '$user_id[0]'"; 
           include('editionprofiladmin.php');
            header("Location: editionprofiladmin.php?id=".$user_id[0]);  

            $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
          $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
 
            //   $reqpdf = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND lower(extension) in ('.pdf','.PDF')");           
*/
     
    $user = $_SESSION['pseudo'];
  
  //  $reqpdf = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND extension = ?");
    $reqpdf = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND lower(extension) in ('.pdf','.PDF')"); 
    $reqpdf->execute(array($user));
    $req_pdf = $reqpdf->fetch();
 //   echo "Nombre de pdf '$req_pdf[0]'";
    
    $reqdoc = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND lower(extension) in ('.doc','.DOC')"); 
    $reqdoc->execute(array($user));
    $req_doc = $reqdoc->fetch();
   // echo "Nombre de doc '$req_doc[0]'";

    $reqdocx = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND lower(extension) in ('.docx','.DOCX')"); 
    $reqdocx->execute(array($user));
    $req_docx = $reqdocx->fetch();
   // echo "Nombre de docx '$req_docx[0]'";

    $reqpublic = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND visibilite = 'public'"); 
    $reqpublic->execute(array($user));
    $req_public = $reqpublic->fetch();
  //  echo "Nombre de public '$req_public[0]'";

    $reqprivate = $bdd->prepare("SELECT COUNT(*) FROM files WHERE pseudo = ? AND visibilite = 'private'"); 
    $reqprivate->execute(array($user));
    $req_private = $reqprivate->fetch();
  //  echo "Nombre de private '$req_private[0]'";

?>





<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Site SmartDoc</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/Team-Boxed.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/footer.css">
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


            </ul><span class="navbar-text actions"> <a class="btn btn-light action-button" role="button" href="deconnexion.php">Déconnexion</a></span></div>
    </div>
</nav>
    <section style="background-image: url(&quot;assets/img/3image.jpg&quot;);">
        <h1 class="text-capitalize text-center" data-aos="fade" data-aos-duration="3000" style="color: #ffffff;font-size: 100px;"><strong>Statistiques</strong></h1>
        <hr style="color: #ffffff;font-size: 27px;background-color: #ffffff;width: 700px;height: 3px;">
        <p class="text-center" style="color: #f1f7fc;"><strong>Découvrez vos statistiques sur les fichiers que vous avez téléchargé sur votre espace</strong></p>
        <p class="text-center" style="color: #f1f7fc;"><i class="fa fa-file-o bounce animated" style="font-size: 50px;margin-bottom: 35px;color: rgb(225,197,48);"></i></p>
    </section>

</br>
    <section>

         <h3 class="text-center"><strong><em>Statistiques en fonction de la visibilité de vos documents</em></strong></h3>
        <div data-aos="fade" data-aos-duration="3000" style="margin: 40px;padding: 115px;"><canvas data-bs-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;DOCUMENT PRIVEE&quot;,&quot;DOCUMENT PUBLIC&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Fréquence&quot;,&quot;backgroundColor&quot;:&quot;#df4e4e&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;<?php echo($req_private[0]); ?>&quot;,&quot;<?php echo($req_public[0]); ?>&quot;,&quot;0&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas></div>


    </section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-animation.js"></script>
    <script src="assets/js/bs-charts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
</body>


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

</html>