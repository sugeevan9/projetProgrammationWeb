<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre;charset=utf8', 'root', '');

$membres = $bdd->query('SELECT * FROM membres ORDER BY id DESC LIMIT 0,5');

$lien = 'Location: http://localhost:8080/web/web10/admin.php';

 if(!isset($_SESSION['id'])) {

         echo "Aucun utilisateur connecter ";
         echo '<a href="connexion.php">Connecter vous !</a>';
         exit;
      
   }


//   if (strcasecmp($_SESSION['pseudo'], 'admin') ==! 0){


 if (strcasecmp($_SESSION['droit'], 'admin') ==! 0){

         echo "Vous n'avez pas les accées pour accéder à cette page";

         exit;
      
   }
    	


   if(isset($_POST['formadmin'])) {
   		
  	

       if(!empty($_POST['supp_user'])){

            $user_a_supp = $_POST['supp_user'];
            $req = $bdd->query('DELETE FROM membres WHERE pseudo ="'.$user_a_supp.'"');
            echo 'Compte supprimer';
            
           
			       header($lien);
             
         } else {
            echo 'Choisiez une personne';
         }
   
   }


 

      
    if(isset($_POST['forminscription'])) {
       $pseudo = htmlspecialchars($_POST['pseudo']);
       $mail = htmlspecialchars($_POST['mail']);
       $mail2 = htmlspecialchars($_POST['mail2']);
       $mdp = sha1($_POST['mdp']);
       $mdp2 = sha1($_POST['mdp2']);
       $droit = htmlspecialchars($_POST['droit']);

       if(!empty($_POST['droit'])){

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
                           $erreur = "Le compte a bien été créé !";
                           header($lien);
                 
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
      } else {
         $erreur = "Rentrer un droit !";
      }
    }





   if(isset($_POST['modifuser'])) {
      
    

       if(!empty($_POST['supp_user'])){

          

            $user_a_modiff = $_POST['supp_user'];
       //      echo "La personne '$user_a_modiff'"; 
            $reqid = $bdd->prepare("SELECT id FROM membres WHERE pseudo = ?");
            $reqid->execute(array($user_a_modiff));
            $user_id = $reqid->fetch();
      //     echo "La personne '$user_id[0]'"; 
     //       include('editionprofiladmin.php');
            header("Location: editionprofiladmin.php?id=".$user_id[0]);  
            
      /*      foreach($user_id as $value){
                //Print the element out.
                echo $value, '<br>';
            }
        */

         } else {
            echo 'Choisiez une personne';
         }
   
   }
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title>Administration</title>
<style type="text/css">
		   table
		{
		    border-collapse: collapse;
		}
		td, th /* Mettre une bordure sur les td ET les th */
		{
		    border: 1px solid black;
		}

</style>
</head>
<body>
  
  <h1>Liste des utilisateurs</h1>

  	</br>
  	</br>
   	<table> 	
    <tr>
       <th>id</th>
       <th>pseudo</th>
       <th>mail</th>
       <th>droit</th>
   </tr>
   
      <?php while($m = $membres->fetch()) { ?>
	      <tr>
	      	<th><?= $m['id'] ?> </th>
	      	<th><?= $m['pseudo'] ?></th>
	      	<th><?= $m['mail'] ?></th>
          <th><?= $m['droit'] ?></th>
	       </tr>
	      
      <?php 
  	  } 
  	  ?>

  	</table>
  	</br>
  	</br>

 	<h1>Choisiser un membre à supprimer</h1>
	</br>
  	</br>

  	<form method="POST" enctype="multipart/form-data">

  	<select name="supp_user">
 
		<?php
		 
		$reponse = $bdd->query('SELECT * FROM membres');
		 
		while ($donnees = $reponse->fetch())
		{

		?>
		           <option value="<?php echo $donnees['pseudo']; ?>"> <?php echo $donnees['pseudo']; ?></option>
		<?php
		}
		 
		?>
	</select>
	
	<input type="submit" value="Supprimer la personne" name="formadmin"/>
  <input type="submit" value="Modifier la personne" name="modifuser"/>

 	</form>


 </br>


  <div class="login">

    <form method="POST">
 
        <h1 class="sr-only">Création personne</h1>


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

      </br>

      <select name="droit">

          <option value="">Sélectionner le droit de la personne</option>
          <option value="admin">admin</option>
          <option value="aucun">aucun</option>

        </select>

        </br>
        </br>

        <div class="form-group">

            <button class="btn btn-primary btn-block" type="submit" name="forminscription">Créer la personne</button>

        </div>



        <?php
        if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
        }
        ?>


         

    </form>

</body>
</html>