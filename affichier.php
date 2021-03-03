<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }
$scandir = scandir("./uploads");
foreach($scandir as $fichier){
    echo "$fichier<br/>";
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
<form method="POST" action="./recupfichier">
<input type="submit" name="envoyer des fichier" value="envoyer des fichier" >
</form>
</div>
</div>
</div>
</html>