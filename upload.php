
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


	<!doctype html>
	<html>

		<head>
				<title>Upload de fichier</title>
				<meta charset="UTF-8" />
		</head>
		<body> 
			<h1> Uploader un fichier PDF</h1>
			
			<form method="POST" enctype="multipart/form-data">

				<input type="file" name="fichier">
			</br>

			</br>
				<select name="genre">

					<option value="">Sélectionner le genre de votre document</option>
					<option value="webbook">Web Book</option>
					<option value="devoir">Devoir</option>
					<option value="documentperso">Document Personnelle</option>

				</select>

			</br>
				
			

			 </br>

		      <select name="visibilite">

		          <option value="">Sélectionner la visibilité de votre document</option>
		          <option value="public">public</option>
		          <option value="private">privée</option>

		        </select>

		        </br>
		        </br>

		        <input type="submit" value="Envoyer le fichier" name="formupload"/>




			</form>
			
			

		      
		</body>

	</html>