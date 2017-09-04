<?php
/**
* This is a common include file with headers and datebase information
* 
* 
*/

//Credentials/information to connect to server
$dsn = 'mysql:host=localhost;dbname=cs602finalproject';
$username = 'cs602_user';
$password = 'cs602_secret';

/**
* This function will render the header on every page,
* including the opening html tag,
* the head section and the opening body tag.
* It should be called before any output of the
* page itself.
* @param string $title the page title
*/
function showHeader($title)
{
?>
<html>
<head><title><?=htmlspecialchars($title)?></title></head>
<body>
<h1><?=htmlspecialchars($title)?></h1>
<a href="summary.php">Summary</a>
<a href="expenses.php">My Expenses</a>
<a href="addExpense.php">Add Expenses</a>
<a href="searchExpense.php">Search Expenses</a>
<a href="logout.php">Log Out</a>
<hr>
<?php
}
/**
* This function will 'close' the body and html
* tags opened by the showHeader() function
*/
function showFooter()
{
?>
</body>
</html>
<?php
}

// Create the connection object
$db = new PDO($dsn, $username, $password);

function pr_dump($var) { 
	print '<pre>'; print_r($var); print '</pre>'; 
}


