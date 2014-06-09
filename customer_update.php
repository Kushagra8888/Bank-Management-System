<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Update Customer</title>
</head>

<body>
<div>
<h1>Update Employee Form</h1>
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

$customerequery = "select * from customer where custid=".$_SESSION['custid'];
$cutomerResult = @mysql_query($customerequery);
if ($cutomerResult){
$customer = mysql_fetch_assoc($cutomerResult);
}

if (isset($_POST['updatecustomer'])){   
	$login = $_POST['login'];
	$name = $_POST['name'];
    $email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	
	$query = "update customer set name='".$name."', email='".$email."', phone=".$phone.", address='".$address.
	"' where login ='".$login."'";
	#echo $query;
	$result = @mysql_query($query);
	
	if(!$result){
	$msg = "Invalid entry!";
	}else{
	$msg = "Customer $login has been successfully Updated</b>";
    $cutomerResult = @mysql_query($customerequery);
	$customer = mysql_fetch_assoc($cutomerResult);
	}

}
mysql_close($link);
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table>
   <tr><td>Customer Name</td><td><input type="text" name="name" value="<?php echo $customer['name']?>"></td></tr>
   <tr><td>Login</td><td><input type="text" name="login" value="<?php echo $customer['login']?>" readonly ></td></tr>
   <tr><td>Email</td><td><input type="text" name="email" value="<?php echo $customer['email']?>"></td></tr>
   <tr><td>Phone</td><td><input type="text" name="phone" value="<?php echo $customer['phone']?>"></td></tr>
   <tr><td>Address</td><td><input type="textarea" name="address" value="<?php echo $customer['address']?>"></td></tr>
   <tr><td>SSN No</td><td><input type="text" name="ssn_no" value="<?php echo $customer['ssn_no']?>" readonly></td></tr>
   <tr><td></td><td><input type="submit" name="updatecustomer" value="Update Customer"></td></tr>
   </table>
</form>
<p class = "err"><?php
if(isset($_POST['updatecustomer'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
</body>
</html>