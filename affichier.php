<?php 
 session_start();
 if(empty($_SESSION['id_user'])){
   //redirection
   header('location : index.php');
   exit();
}
$scandir = scandir("./uploads");
foreach($scandir as $fichier){
    echo "$fichier<br/>";
}

?>