<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>View Customers</h1>
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

$customerquery = "SELECT * from customer";
$customerslist = @mysql_query($customerquery);
if(isset($_POST['update'])) 
{ 
	if (isset($_POST['select'])){
		$_SESSION['custid'] = $_POST['select'];
		header("location: customer_update.php");
	}
	else{
		$msg = "No row selected";
	}
}
if(isset($_POST['delete'])) { 
	if (isset($_POST['select'])){
		$query = "DELETE FROM customer WHERE custid=".$_POST['select'];
		$result = @mysql_query($query);
		if ($result){
		$msg = "Sucessfully deleted employee id ".$_POST['select'];
		$customerslist = @mysql_query($customerquery);
		}
	}
	else {
		$msg = "No row selected";
	}

}

echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<table border=1>";
echo "<tr><th>Select<th>Customer ID<th>Name <th>Login <th>Email<th>Phone<th>Address<th>ssn no</tr>";
  while ($row = mysql_fetch_assoc($customerslist)){
   echo "<tr><td><input type='radio' name='select' value='".$row['custid']."'><td>".$row['custid'].
   "<td>".$row['name']."<td>".$row['login']."<td>".$row['email']."<td>".$row['phone']."<td>".$row['address']."<td>".$row['ssn_no'];
  }
   ?>
</table>   
   <input type="submit" name="update" value="Update Record">
   <input type="submit" name="delete" value="Delete Record">
</form>
<p class = "err"><?php
if(isset($_POST['delete'])||isset($_POST['update'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
</body>
</html>