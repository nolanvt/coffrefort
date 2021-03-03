<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }
?>
<html>
<link href="assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
        <div class="phppot-container">
		<div class="sign-up-container">
			<div class="">
<form action="Model/cible_envoi.php" method="post" enctype="multipart/form-data">

       <p>

               Formulaire d'envoi de fichier :<br />

               <input type="file" name="monfichier" /><br />

               <input type="submit" value="Envoyer le fichier" />

       </p>

</form>
</div>
</div>
</div>
</html>
