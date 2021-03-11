<?php

// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur

if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)

{

       // Testons si le fichier n'est pas trop gros

       if ($_FILES['monfichier']['size'] <= 200000)

       { 

               // Testons si l'extension est autorisée

               $infosfichier = pathinfo($_FILES['monfichier']['name']);

               $extension_upload = $infosfichier['extension'];

               $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

               if (in_array($extension_upload, $extensions_autorisees))

               {

                // On peut valider le fichier et le stocker définitivement

                       move_uploaded_file($_FILES['monfichier']['tmp_name'],
                       '../uploads/' . basename($_FILES['monfichier']['name']));
                       ?>
                       <html>
                       <div id="header" style="text-align: center; font-size: 20px; margin: 85px 0px -50px;">l' envoi a bien été effectué !;
</html>
<?php
               }

       }else { echo "Fichier trop lourd moins de 200ko";}

}

?>

<html>
<link href=".//assets/css/phppot-style.css" type="text/css"
	rel="stylesheet" />
<link href="../assets/css/user-registration.css" type="text/css"
	rel="stylesheet" />
         <div class="phppot-container">
		<div class="sign-up-container">
			<div class="">
<form method="POST" action="../landing">
<input type="submit" name="etourner a l'affichage des fichier" value="Retourner a l'acueil" >
</form>
<br>
<br>
<br>
<form method="POST" action="./recupfichier">
<input type="submit" name="renvoyer des fichier" value="renvoyer des fichier" >
</form>
</div>
</div>
</div>
</html>