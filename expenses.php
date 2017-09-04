<?php
/**
* This page lists all the students we have
*/

include('basicTemplate.php');

// makes sure user is logged in before user can access this page, otherwise redirects to login page.
session_start();
$loggedIn = $_SESSION['logged_in'];

//current user's information
$userName = $_SESSION['name'];	
$id = $_SESSION['id'];	

if($loggedIn == false) {

	header("location: index.php");
}

$query = 'SELECT * FROM expense WHERE userId=:userId ORDER BY entryDate';

$statement = $db->prepare($query);
$statement->bindValue(':userId', $id);			
$statement->execute();

// Display the header
showHeader('List of all incomes and expenses');
// now create the table
?>

<table width="50%" border="1" cellpadding="3">
	<tr style="font-weight: bold">
		<td>Date</td>
		<td>Amount</td>
		<td>Category</td>
		<td>Type</td>	
		<td>Modify</td>			
	</tr>
<?php

while($result = $statement->fetch(PDO::FETCH_ASSOC))
{
	$date = $result["entryDate"];
	$amount = $result["amount"];
	$category = $result["category"];
	$type = $result["type"];

	echo "<tr><td> " . $date . "</td> <td> " . $amount . "</td> <td> " . $category . "</td> <td> " . $type . "</td>";
?>
	<td>
		<a href="editExpense.php?expense=<?=$result['id']?>">Edit</a>
		<a href="deleteExpense.php?expense=<?=$result['id']?>">Delete</a>			
	</td>
	</tr>
<?php
}
?>
</table>
<?php
// Display footer
showFooter();
?>
