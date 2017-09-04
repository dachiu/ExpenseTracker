<?php
/**
* This page adds the user to the database.
*/

include('basicTemplate.php');

$warnings = array();

// Now see if the form was submitted
if(isset($_POST['submit'])) {
	// Validate every field

	// email address
	if(!$_POST['emailAddress']) {
		$warnings[] = 'Please enter your email address';
	}
	// firstname
	if(!$_POST['firstName']) {
		$warnings[] = 'Please enter your first name';
	}
	// lastname
	if(!$_POST['lastName']) {
		$warnings[] = 'Please enter your last name';
	}
	// password
	if(!$_POST['password']) {
		$warnings[] = 'Please enter a password';
	}	

	// If there are no errors, we can update the database
	if(count($warnings) == 0) {
        $sql = "INSERT INTO userdata(firstName, lastName, emailAddress, password) VALUES(" .
        $db->quote($_POST['firstName']) .
        ', ' . $db->quote($_POST['lastName']) .
        ', ' . $db->quote($_POST['emailAddress']) .
        ', ' . $db->quote($_POST['password']) .
        ')';

	    $db->query($sql);   

		header("Location: index.php");
		exit;
	}
}
else {
    // If we have any warnings, display them now
	//echo "<b>Please correct these errors:</b><br>";
	foreach($warnings as $w)
	{
		echo "- ", htmlspecialchars($w), "<br>";
	}
}

?>

<html>
<head>
	<title>ExpenseTracker Registration Page</title>
</head>
<body>
	<div id="main">
		<h1>ExpenseTracker Registration Page</h1>
		<div id="login">
		<h2>Registration Form</h2>
        <form name="registration" method="post" action="registration.php">
            <table border="0" width="500">
                <tr>
                    <td>Email Address</td>
                    <td><input type="text" name="emailAddress"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="firstName"></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="lastName"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Register" ></td>
                </tr>
            </table>
        </form>
	</div>
</body>
</html>

