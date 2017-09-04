<?php
/**
* This page allows you to add or edit a student
*/

include('basicTemplate.php');

// makes sure user is logged in before user can access this page, otherwise redirects to login page.
session_start();
$loggedIn = $_SESSION['logged_in'];

if($loggedIn == false) {

	header("location: index.php");
}

// See if we have the student ID passed in the request
$id = NULL;

if (isset($_REQUEST['expense'])) {
	$id = (int)$_REQUEST['expense'];
}

if($id) {
	// We have the ID, get the student details from the table
	$q = $db->query("SELECT * FROM expense WHERE id=$id");
	$expense = $q->fetch(PDO::FETCH_ASSOC);
	$q->closeCursor();
	$q = null;
}
else {
	// We are creating a new expense
	$expense = array('entryDate' => '', 'amount' => '', 'category' => '', 'type' => '');
}

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

	// If there are no errors, we can update the database
	// If there was student ID passed, update that student
	if(count($warnings) == 0) {
		if(@$expense['id']) {
			$sql = "UPDATE expense SET entryDate=" .
			$db->quote($_POST['entryDate']) .
			', amount=' . $db->quote($_POST['amount']) .
			', category=' . $db->quote($_POST['category']) .
			', type=' . $db->quote($_POST['type']) .
			" WHERE id=$expense[id]";
		}
		else {
			$sql = "INSERT INTO expense(entryDate, amount, category, type) VALUES(" .
			$db->quote($_POST['entryDate']) .
			', ' . $db->quote($_POST['amount']) .
			', ' . $db->quote($_POST['category']) .
			', ' . $db->quote($_POST['type']) .
			')';
		}
		$db->query($sql);
		header("Location: expenses.php");
		exit;
	}
}
else {
	// Form was not submitted.
	// Populate the $_POST array with the student's details
	$_POST = $expense;
}

// Display the header
showHeader('Edit Expense');
// If we have any warnings, display them now
if(count($warnings)) {
	echo "<b>Please correct these errors:</b><br>";
	foreach($warnings as $w)
	{
		echo "- ", htmlspecialchars($w), "<br>";
	}
}
// displays the edit form
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

<form action="editExpense.php" method="post">
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
				<input type="submit" name="submit" value="Save">		
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



