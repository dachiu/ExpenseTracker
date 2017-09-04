<?php
/**
* This page allows you to add
*/

include('basicTemplate.php');

// makes sure user is logged in before user can access this page, otherwise redirects to login page.

session_start();
$loggedIn = $_SESSION['logged_in'];
if($loggedIn == false) {

	header("location: index.php");
}

//current user's information
$userName = $_SESSION['name'];	
$id = $_SESSION['id'];	

$expense = array('userId' => '', 'entryDate' => '', 'amount' => '', 'category' => '', 'type' => '');

$warnings = array();

// Now see if the form was submitted
if(isset($_POST['submit'])) {
	// Validate every field

	// date of expense
	if(!$_POST['entryDate']) {
		$warnings[] = 'Please choose a correct date';
	}
	// amount of expense
	if(!$_POST['amount']) {
		$warnings[] = 'Please enter an amount';
	}
	// category of expense
	if(!$_POST['category']) {
		$warnings[] = 'Please enter a category';
	}
	// type of expense
	if(!$_POST['type']) {
		$warnings[] = 'Please enter a type';
	}	

	// If there are no errors, we can update the database
	if(count($warnings) == 0) {
		$query = '
				INSERT INTO expense(userId, entryDate, amount, category, type) 
				VALUES(:userId, :entryDate, :amount, :category, :type)';

		$statement = $db->prepare($query);
		$statement->bindValue(':userId', $id);			
		$statement->bindValue(':entryDate', $_POST['entryDate']);
		$statement->bindValue(':amount', $_POST['amount']);
		$statement->bindValue(':category', $_POST['category']);
		$statement->bindValue(':type', $_POST['type']);			
		$statement->execute();

		header("Location: summary.php");
		exit;
	}
}
else {
	// Form was not submitted.
	$_POST = $expense;
}

// Display the header
showHeader('Add expense/income');
// If we have any warnings, display them now
if(count($warnings)) {
	echo "<b>Please correct these errors:</b><br>";
	foreach($warnings as $w)
	{
		echo "- ", htmlspecialchars($w), "<br>";
	}
}

// displays the add form
?>

<head>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <meta name=viewport content="width=device-width, initial-scale=1">
	
    <script>
        $(function() {
            $( "#datepicker" ).datepicker({dateFormat: "mm-dd-yy"});

        });
    </script>
</head>

<form action="addExpense.php" method="post">
	<table border="1" cellpadding="3">
		<tr>
			<td>Entry Date</td>
			<td>
				<input type="text" name="entryDate" id="datepicker"
				value="<?=htmlspecialchars($_POST['entryDate'])?>">
			</td>
		</tr>
		<tr>
			<td>Amount</td>
			<td>
				<input type="text" name="amount"
				value="<?=htmlspecialchars($_POST['amount'])?>">
			</td>
		</tr>
		<tr>
			<td>Category</td>
			<td>
				<select name="category">
				<option value="job">job</option>					
				<option value="rent">rent</option>
				<option value="gas">gas</option>
				<option value="electricity">electricity</option>
				<option value="water">water</option>
				<option value="other">other</option>				
				</select>

			</td>			
		</tr>
		<tr>
			<td>Type</td>
			<td>
				<span>
				<input type="radio" name="type" value="expense">Expense</label>
				<input type="radio" name="type" value="income">Income</label>
				</span>
			</td>			
		</tr>		
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Add">		
			</td>	
		</tr>
	</table>
	<?php if(@$expense['id']) { ?>
		<input type="hidden" name="expense" value="<?=$expense['id']?>">
	<?php } ?>
</form>

<?php
// Display footer
showFooter();

?>