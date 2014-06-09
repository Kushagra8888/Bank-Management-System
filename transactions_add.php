<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>Add Transaction Form</h1>
<?php
require_once('auth.php');
require_once("config.php");
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db(DB_NAME);

//Query the list of account nos. from the accounts table
$accountsquery = "SELECT account_no from accounts";
$accountslist = @mysql_query($accountsquery);
   

	$query = "insert into transactions (account_no, type, mode, amount, date) 
			  values ('$account_no', '$type', '$mode', $amount, $date);";
	$result = @mysql_query($query);
	if(!$result){
		echo "Transaction couldnt be inserted.";
	}else{
		echo "Transaction details were successfully added</b>";
		echo "<br>You can use the following form again to enter a new transaction."; 
		$accountslist = @mysql_query($accountsquery);
	}
	
}

mysql_close($link);
?>

<!-- Input form for data entry -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table>
   <tr><td>Account no.</td><select name="accountno">
   <!-- Display the obtained list of account nos as options   -->
   <?php
	if ($managerslist){
		while ($row = mysql_fetch_assoc($accountslist)){
			echo "<option value=".$row['account_no']."</option>";
		}
	}
   ?>
   </select></tr>
   <tr><td>Type</td><select name="type">
   <option value="Credit">Credit</option>
   <option value="Debit">Debit</option>
   </select></tr>
   <tr><td>Mode</td><select name="mode">
   <option value="Cash">Cash</option>
   <option value="Cheque">Cheque</option>
   <option value="D.D">D.D</option>
   </select>
   </tr>
   <tr><td>Date</td><input type="text" name="date"></tr>
   <input type="hidden" name="submitted" value="no">
   <table>
</form>
<?php require_once('footer.php') ?>
</div>
</body>
</html>