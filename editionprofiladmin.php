<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');

if(isset($_GET['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = ?");
   $requser->execute(array($_GET['id']));
   $user = $requser->fetch();
   if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo']) {
      $newpseudo = htmlspecialchars($_POST['newpseudo']);
      $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id = ?");
      $insertpseudo->execute(array($newpseudo, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }

    if(isset($_POST['droit']) AND !empty($_POST['droit']) AND $_POST['droit'] != $user['droit']) {
      $newdroit = htmlspecialchars($_POST['droit']);
      $insertdroit = $bdd->prepare("UPDATE membres SET droit = ? WHERE id = ?");
      $insertdroit->execute(array($newdroit, $_GET['id']));
      header('Location: editionprofiladmin.php?id='.$_GET['id']);
   }

   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membres SET motdepasse = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_GET['id']));
         header('Location: editionprofiladmin.php?id='.$_GET['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
   <head>
      <title>TUTO PHP</title>
      <meta charset="utf-8">
   </head>
   <body>
      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
            
           <?php echo $_GET["id"]; ?> 
               <label>Pseudo :</label>
               <input type="text" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newmdp1" placeholder="Mot de passe"/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />

               </br>

               <?php
                     $droit = $_GET['id'];
               
                     $reqid = $bdd->prepare("SELECT droit FROM membres WHERE id = ?");
                     $reqid->execute(array($droit));
                     $droit = $reqid->fetch();
             
                    
           
                 echo 'Droit actuelle de la personne : '.$droit[0]."</font>";
                 
               ?>
               </br>
               </br>
               <select name="droit">

                   <option value="">Sélectionner le nouveau droit de la personne</option>
                   <option value="admin">admin</option>
                   <option value="aucun">aucun</option>

               </select>
                </br>
                 </br>

               <input type="submit" value="Mettre à jour mon profil !" />

                </br>

            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
             <a href="admin.php">Retour à page d'administration</a>
         </div>
      </div>
   </body>
</html>
<?php   
}
else {
   header("Location: admin.php");
}
?>