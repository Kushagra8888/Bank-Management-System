<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>Add Account Form</h1>
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

$custidquery = "SELECT custid, name from customer";
$custidlist = @mysql_query($custidquery);

if(isset($_POST['submit']))  {
	$custid = $_POST['custid'];
    if (isset($_POST['accountType'])){
	$accountType=$_POST['accountType'];
	}
	$balance=$_POST['balance'];
	if (isset($_POST['DateOfOpening'])){
	$DateOfOpening = $_POST['DateOfOpening'];
	}
	
	$query = "insert into accounts (owner, account_type, balance, date_of_opening) 
	values ($custid, '$accountType', $balance,'$DateOfOpening')";
	#echo $query;
	$result = @mysql_query($query);
	if(!$result){
	$msg =  "Invalid entry!";
	}else{
	$msg =  "A new Account has been added for customer id $custid</b>";
    echo "<br>You can use the following form again to enter a new account."; 
	}
	}
mysql_close($link);
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table>
   <tr><td>Account type<td><select name="accountType">
   <option value="Saving">Saving</option>
   <option value="Current">Current</option>
   </select>
   <tr><td>Date of openeing<td><input type="date" name="DateOfOpening"></tr>
   <tr><td>Balance<td><input type="text" name="balance"></tr>
   <tr><td>Owner<td><select name = "custid">
   <?php
   if ($custidlist){
		while ($row = mysql_fetch_assoc($custidlist)){
		echo "<option value=".$row['custid'].">".$row['name']."</option>";
	}
   }
	?>
   </select>
   <tr><td></td><td><input type="submit" name="submit" value="Add Account"></td></tr>
   </center>
   </table>
</form>
<p class = "err"><?php
if(isset($_POST['submit'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
</body>
</html>