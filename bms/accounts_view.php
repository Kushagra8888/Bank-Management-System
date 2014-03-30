<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Accounts Home Page</title>
</head>

<body>
<div>
<h1>View Accounts</h1>
<div id="menu">
<ul>
<li><a href="AdminHome.php">Home</a></li></ul>
<ul>
<li><a href="#">Insert</a>    <!--This is in main menu-->
<ul>
<li><a href="employee_add.php">Employee</a></li>   <!--This is in drop downmenu-->
<li><a href="customer_add.php">Customer</a></li>    <!--This is in drop downmenu-->
<li><a href="accounts_add.php">Account</a></li>    <!--This is in drop downmenu-->
</ul>
</li>
<li><a href="#">View </a>    <!--This is in main menu-->
<ul>
<li><a href="employee_view.php">Employee</a></li>   <!--This is in drop downmenu-->
<li><a href="customer_view.php">Customer</a></li>    <!--This is in drop downmenu-->
<li><a href="accounts_view.php">Account</a></li>    <!--This is in drop downmenu-->
<li><a href="transaction_view.php">Transactions</a></li>    <!--This is in drop downmenu-->
</ul>
</li>
</ul>
<ul><li><a href="About.php">About</a></li></ul>
<ul><li><a href="index.php">Logout</a></li></ul>
</div>
<br><br><br>
<?php
require_once('auth.php');
require_once("config.php");
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db(DB_NAME);

$accountsquery = "SELECT accounts.accountno , accounts.account_type, accounts.balance, accounts.date_of_opening,
customer.name from accounts LEFT JOIN customer ON accounts.owner=customer.custid group by customer.name";
$accountslist = @mysql_query($accountsquery);
if(isset($_POST['delete'])){
	if(isset($_POST['select'])){
		$query = "DELETE FROM accounts WHERE accountno=".$_POST['select'];
		$result = @mysql_query($query);
		if ($result){
			$msg = "Sucessfully deleted acount id ".$_POST['select'];
			$accountslist = @mysql_query($accountsquery);
		}
	}
	else{
		$msg = "no rows selected";
	}
}

echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<table border=1>";
echo "<tr><th>Select<th>accountno<th>Account Type<th>Date Of Opening<th>Balance<th>Owner</tr>";
  while ($row = mysql_fetch_assoc($accountslist)){
   echo "<tr><td><input type='radio' name='select' value='".$row['accountno']."'><td>".$row['accountno'].
   "<td>".$row['account_type']."<td>".$row['date_of_opening']."<td>".$row['balance']."<td>".$row['name'];
  }
   ?>
</table>   
   <input type="submit" name="delete" value="Delete Record">
</form>
<p class = "err"><?php
if(isset($_POST['delete'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
</body>
</html>
