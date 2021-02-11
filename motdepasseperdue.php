<?php
	//Start session
	session_start();
?>
<html>
<body>
<div id="header" style="text-align: center; font-size: 20px; margin: 85px 0px -74px;"> mot de passe oublier
</div>
<div id="loginform">
<form action="reconnexion.php" method="post">
<span>email :</span><input type="text" name="email" /><br><br>
<span>&nbsp;</span><input id="btn" type="submit" value="Login" />
</form>
</div>
</body>
</html>