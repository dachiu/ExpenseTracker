<?php
/*
*Default page that shows the login page.
*
*
*/

include('basicTemplate.php');

//starts session management
$lifetime = 60 * 60 * 24 * 14; // 2 weeks in seconds
session_set_cookie_params($lifetime, '/');
session_start(); // Starting Session	

$_SESSION['logged_in'] = false;

if($_SESSION['logged_in'] == true){
	header("location: summary.php");
}
?>

<?php
	$error=''; // Variable To Store Error Message

	if (isset($_POST['submit'])) {
		if (empty($_POST['emailAddress']) || empty($_POST['password'])) {
			$error = "Please enter Username and Password";
		}
		else
		{
			// Define $username and $password
			$emailAddress=$_POST['emailAddress'];
			$password=($_POST['password']);
			//$password=md5($_POST['password']);

			$query = "SELECT * FROM userData where emailAddress='$emailAddress' AND password='$password'";
			$statement = $db->prepare($query);
			$statement->execute();
			$result = $statement->fetch();
			$statement-> closeCursor();

		if($result == true)
		{
			$_SESSION['logged_in'] = true; // Initializing Session
    		$_SESSION['id']=$result['uid'];	
    		$_SESSION['name']=$result['firstName'];						
			header("location: summary.php"); // Redirecting To Other Page
		} else {
			$error = "Username or Password is invalid";
		}

		}
	}
?>

<html>
<head>
	<title>ExpenseTracker Login Page</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript">
		function register() {
			location.href = "registration.php";
		};
	</script>	
</head>
<body>
	<div id="main">
		<h1>ExpenseTracker Login Page</h1>
		<div id="login">
		<h2>Login Form</h2>
		<form action="" method="post">
			<label>UserName :</label>
			<input id="emailAddress" name="emailAddress" placeholder="email address" type="text">
			<label>Password :</label>
			<input id="password" name="password" placeholder="**********" type="password">
			<input name="submit" type="submit" value=" Login ">
			<span><?php echo $error; ?></span>
		</form>
		</div>
		<div>
			<h2>New User?</h2>
			<button type="button" id="registerButton" onclick="register()">Register!</button>
		</div>
	</div>
</body>
</html>

