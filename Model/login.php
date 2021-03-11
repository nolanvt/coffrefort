<?php
//Start session
session_start();

//Array to store validation errors
$errmsg_arr = array();

//Validation error flag
$errflag = false;

//Connect to mysql server
$link = mysqli_connect('localhost', 'root', '', 'coffre');
if (!$link) {
	die('Failed to connect to server: ' . mysql_error());
}


//Function to sanitize values received from the form. Prevents SQL injection
function clean($str)
{

	$str = @trim($str);
	if (get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return $str;
	/*		return  mysqli_real_escape_string($link,$str);*/
}

//Sanitize the POST values
$email = clean($_POST['email']);
$password = clean($_POST['password']);
$password = password_hash($password, PASSWORD_DEFAULT);
//Input Validations
if ($email == '') {
	$errmsg_arr[] = 'Username missing';
	$errflag = true;
}
if ($password == '') {
	$errmsg_arr[] = 'Password missing';
	$errflag = true;
}

//If there are input validations, redirect back to the login form
if ($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: ../index.php");
	exit();
}

//Create query
$qry = "SELECT * FROM tbl_member WHERE email='$email' AND password='$password'";
$result = mysqli_query($link, $qry);

//Check whether the query was successful or not
if ($result) {
	if (mysqli_num_rows($result) > 0) {
		//Login Successful
		session_regenerate_id();
		$member = mysqli_fetch_assoc($result);
		$_SESSION['SESS_MEMBER_ID'] = $member['id'];
		$_SESSION['SESS_FIRST_NAME'] = $member['name'];
		session_write_close();
		header("location: ../affichier.php");
		echo " tu est connecter";

		exit();
	} else {
		//Login failed
		$errmsg_arr[] = 'pas dans la database'.$qry;
	$errflag = true;
		if ($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr ;
	session_write_close();
	header("location: ../index.php");
	exit();
}
		exit();
	}
} else {
	die("Query failed");
}
