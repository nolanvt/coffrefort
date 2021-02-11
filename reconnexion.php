<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "coffre";
$email = $_POST["email"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `prenom` , `id`, `email` ,`mot de passe` FROM user where `email` = '".$email."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if ($_POST["email"] == $row["email"])
        echo "<br> id: ". $row["id"]. " - prenom: ". $row["prenom"] ."  - mot de passe: ". $row["mot de passe"]."<br>";
    }
} else {
    echo "adresse email eronner";
	echo $email;
	echo $sql;
}

$conn->close();
?>

</body>
</html>
