
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


		/*		echo 'Nom: '.$file_name.'<br/>';
				echo 'Type: '.$file_type.'<br/>';
				echo 'Extension: '.$file_extension.'<br/>';
				*/

				$extension_autorisees = array('.pdf', '.PDF','.doc','.DOC','.docx','.DOCX');


                if(in_array($file_extension,$extension_autorisees)){
                    if(move_uploaded_file($file_tmp_name, $file_dest)){
						$req = $db->prepare('INSERT INTO files(name, file_url, pseudo, genre, visibilite,extension) VALUES(?,?,?,?,?,?)');
						$req->execute(array($file_name, $file_dest, $userpseudo, $genre, $visibilite, $file_extension));
						echo "Le fichier '$file_name' a bien était uplouder pour utilisateur '$userpseudo'";
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


	<!doctype html>
	<html>

<head>
    <title>Upload sur le site </title>
    <meta charset="UTF-8" />


    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>SmartDoc - Profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/contact.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/navigation.css">
    <link rel="stylesheet" href="assets/css/profil.css">
    <link rel="stylesheet" href="assets/css/text.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">


    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>




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
        <h1 class="text-capitalize text-center" data-aos="fade" data-aos-duration="3000" style="color: #ffffff;font-size: 100px;"><strong>Vos documents privés</strong></h1>
        <hr style="color: #ffffff;font-size: 27px;background-color: #ffffff;width: 700px;height: 3px;">
        <p class="text-center" style="color: #f1f7fc;"><strong>Uploader et télécharger vos fichiers sur votre espace</strong></p>
        <p class="text-center" style="color: #f1f7fc;"><i class="fa fa-file-o bounce animated" style="font-size: 50px;margin-bottom: 35px;color: rgb(225,197,48);"></i></p>
    </section>


    <div class="container">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
        <tr>
            <th>Nom du fichier</th>
            <th>Fichier</th>
            <th>Date de modification</th>


        </tr>
        </thead>
        <tbody>

        <?php

        $userpseudo = $_SESSION['pseudo'];
        $req = $db->query('SELECT name, file_url, date, heure FROM files WHERE pseudo ="'.$userpseudo.'"');


        while($data = $req->fetch()){
            echo '<tr>';

            echo '<th>'.$data['name'].'</th>';
            echo '<th><a href="'.$data['file_url'].'">'.$data['name'].'</a></th>';
            echo '<th>'.$data['date'].' à '.$data['heure'].'</th>';


        }
        ?>

        </tbody>

    </table>
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
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-animation.js"></script>
<script src="assets/js/bs-charts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.1.1/aos.js"></script>
<script src="assets/js/jquery-3.3.1.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>