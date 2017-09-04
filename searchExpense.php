<?php
/**
* This page let's user search expenses by categories.
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


// Display the header
showHeader('Search expenses and incomes');
// now create the table

?>
        Please select your category to search by:
        <form method="post" action="">
        <select name="category">
        <option value="job">job</option>        
        <option value="rent">rent</option>
        <option value="gas">gas</option>
        <option value="electricity">electricity</option>
        <option value="water">water</option>
        <option value="other">other</option>				
        </select>        
        <input type="submit" value="Search">
        </form>

<?php

if (isset($_POST['category'])) {
    $categoryValue = $_POST['category'];   
} else {
    exit;
}
$query = '
        SELECT *
        FROM expense
        WHERE category = :categoryValue and userId = :userId
        ORDER BY entryDate';

    $statement = $db->prepare($query);
    $statement->bindValue(':categoryValue', $categoryValue);
    $statement->bindValue(':userId', $id);	    
    $statement->execute();

?>

    <table width="50%" border="1" cellpadding="3">
        <tr style="font-weight: bold">
            <td>date</td>
            <td>amount</td>
            <td>category</td>
            <td>type</td>	
        </tr>
    <?php

    while($result = $statement->fetch(PDO::FETCH_ASSOC))
    {
        $date = $result["entryDate"];
        $amount = $result["amount"];
        $category = $result["category"];
        $type = $result["type"];

        echo "<tr><td> " . $date . "</td> <td> " . $amount . "</td> <td> " . $category . "</td> <td> " . $type . "</td>";
    }
    ?>
    </table>

<?php
// Display footer
showFooter();
?>
