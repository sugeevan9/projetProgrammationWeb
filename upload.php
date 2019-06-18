
<?php
	session_start();
	require 'includes/connect_db.php';
	/*	var_dump($_FILES); */



	if(!isset($_SESSION['id'])) {

	  		echo "Aucun utilisateur connecter ";
	    	echo '<a href="connexion.php">Connecter vous !</a>';


	    	exit;

	}


	if(isset($_POST['formupload'])) {

	    if(!empty($_POST['genre'])){

			if(!empty($_FILES)){

				$file_name = $_FILES['fichier']['name'];
				$file_type = $_FILES['fichier']['type'];
				$file_extension = strrchr($file_name, ".");
				$file_tmp_name = $_FILES['fichier']['tmp_name'];

				$file_dest = 'files/'.$file_name;

				$userpseudo = $_SESSION['pseudo'];

				$genre = $_POST['genre'];

				$visibilite = $_POST['visibilite'];

				setlocale(LC_TIME, 'fra_fra');
				
				$date = strftime('%d %B %Y');
				$heure = strftime('%H:%M:%S'); ;
	



		/*		echo 'Nom: '.$file_name.'<br/>';
				echo 'Type: '.$file_type.'<br/>';
				echo 'Extension: '.$file_extension.'<br/>';
				*/

				$extension_autorisees = array('.pdf', '.PDF','.doc','.DOC','.docx','.DOCX');


                if(in_array($file_extension,$extension_autorisees)){
                    if(move_uploaded_file($file_tmp_name, $file_dest)){
						$req = $db->prepare('INSERT INTO files(name, file_url, pseudo, genre, visibilite, extension, date, heure) VALUES(?,?,?,?,?,?,?,?)');
						$req->execute(array($file_name, $file_dest, $userpseudo, $genre, $visibilite, $file_extension, $date, $heure));
						echo "Le fichier '$file_name' a bien était upload ! ";
					} else {
						echo "Une erreur est survenue lors de l'envoi du fichier";
					}

				} else{
					echo 'Seuls les fichiers PDF ou DOC/DOCX sont autorisés';
				}

		} else {
			echo 'rentrer un fichier';
		}
	} else {
		echo 'entrée un genre';
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
<div class="container">
    <div align="center" style="margin-top: 200px">
			<h1> Uploader un fichier PDF</h1>


        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">Votre document</label>
                <input type="file" class="form-control" id="exampleFormControlInput1" name="fichier">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Sélectionner le genre de votre document</label>
                <select class="form-control" id="exampleFormControlSelect1" name="genre">
                    <option value="webbook">Web Book</option>
                    <option value="devoir">Devoir</option>
                    <option value="documentperso">Document Personnelle</option>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Sélectionner la visibilité de votre document</label>
                <select class="form-control" id="exampleFormControlSelect1" name="visibilite">
                    <option value="public">public</option>
                    <option value="private">privée</option>
                </select>
            </div>


            </br>
            </br>

            <input type="submit" value="Envoyer le fichier" name="formupload"/>


        </form>
			
    </div></div>


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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>


</html>