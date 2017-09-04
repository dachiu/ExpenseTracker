<?php
/**
* This page gives a summary of the expenses that student incurred.
*/

include('basicTemplate.php');

// Display the header
showHeader('My income/expense Summary');
// now create the table
?>

<?php

// makes sure user is logged in before user can access this page, otherwise redirects to login page.

session_start();
$loggedIn = $_SESSION['logged_in'];

if($loggedIn == false) {

	header("location: index.php");
}

//current user's information
$userName = $_SESSION['name'];	
$id = $_SESSION['id'];	

$totalExpense = 0;
$totalIncome = 0;

echo "Hello, " . $userName . "<br> Your user id# is " . $id . "<br><br>";

// Issue the query
//$q = $conn->query("SELECT * FROM expense WHERE userId=:current_uid ORDER BY entryDate");

$query = '
        SELECT *
        FROM expense
        WHERE userId = :current_uid
        ORDER BY entryDate';

$statement = $db->prepare($query);
$statement->bindValue(':current_uid', $id);
$statement->execute();

// Now iterate over every row and display it
while($result = $statement->fetch(PDO::FETCH_ASSOC))
{
	$amount = $result["amount"];
	$category = $result["category"];
	$type = $result["type"];

    if($type == "expense") {
        $totalExpense = $totalExpense + $amount;
    }

    if($type == "income") {
        $totalIncome = $totalIncome + $amount;
    }
}

    echo "Your total expense is: $" . $totalExpense . "<br>";
    echo "Your total income is: $" . $totalIncome . "<br>";    
?>

<?php
// Display footer
showFooter();
?>
