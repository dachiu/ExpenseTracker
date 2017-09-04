<?php
/**
* This page deletes the selected expense's data from the database.
*/

include('basicTemplate.php');

// makes sure user is logged in before user can access this page, otherwise redirects to login page.
session_start();
$loggedIn = $_SESSION['logged_in'];

if($loggedIn == false) {

	header("location: index.php");
}

// See if we have the ID passed in the request
$uid = NULL;

if (isset($_REQUEST['expense'])) {
	$uid = (int)$_REQUEST['expense'];
}

if($uid) {
	// We have the ID, get the expense from the table and delete it.

	$query = "DELETE FROM expense WHERE id = $uid";
	$statement = $db->prepare($query);
	$statement->execute();
	$statement->closeCursor();

}

// Redirect browser to the student's page
header("Location: expenses.php"); 
exit();



// Display footer
showFooter();

?>


