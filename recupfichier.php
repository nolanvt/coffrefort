<?php
 session_start();
if(empty($_SESSION['id_user'])){
   //redirection
   header('location : index.php');
   exit();
}
?>
<html><form action="Model/cible_envoi.php" method="post" enctype="multipart/form-data">

       <p>

               Formulaire d'envoi de fichier :<br />

               <input type="file" name="monfichier" /><br />

               <input type="submit" value="Envoyer le fichier" />

       </p>

</form>
</html>
