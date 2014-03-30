<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>Add Customer Form</h1>
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

if(isset($_POST['submit'])) 
{ 
	$login = null;
	if (isset($_POST['login'])){
		$login = $_POST['login'];
	}
	$query = "select * from customer where login = '$login'";
	$result = @mysql_query($query);
	
	if(mysql_num_rows($result) == 0){
	
	
	
	$name = $_POST['name'];
    $managerid = '0';
	if (isset($_POST['email'])){
	$email=$_POST['email'];
	}
	$phone=$_POST['phone'];
	$ssnno=$_POST['ssnno'];
	
	if (isset($_POST['address'])){
	$address = $_POST['address'];
	}
	
	$query = "insert into customer (name, login, email, ssn_no, address, phone) 
	values ('$name', '$login', '$email', $ssnno, '$address', $phone);";
	#echo $query;
	$result = @mysql_query($query);
	if(!$result){
	$msg = "Invalid entry!";
	}else{
	$msg = "Customer $name has been successfully added</b>";
    echo "<br>You can use the following form again to enter a new name."; 
	}
	}
	else{
	echo "Record already exists for login $login. Please select a unique login";
	}
}

mysql_close($link);
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table>
   <tr><td>Customer Name</td><td><input type="text" name="name"><td></tr>
   <tr><td>Login</td><td><input type="text" name="login"></td></tr>
   <tr><td>Email</td><td><input type="email" name="email"></td></tr>
   <tr><td>Phone</td><td><input type="number" name="phone"></td></tr>
   <tr><td>ssn no</td><td><input type="number" name="ssnno"></td></tr>
   <tr><td>Address</td><td><input type="textarea" name="address"></td></tr>
   <tr><td></td><td><input type="submit" name="submit" value="Add Customer"></td></tr>
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