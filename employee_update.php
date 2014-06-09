<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Update Employee Page</title>
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

$managerquery = "SELECT emp_id, name from employee WHERE isManager=1";
$managerslist = @mysql_query($managerquery);

$employeequery = "select * from employee where emp_id=".$_SESSION['empid'];
$employeeResult = @mysql_query($employeequery);
$employee = mysql_fetch_assoc($employeeResult);

if (isset($_POST['updateemployee'])){   
	$login = null;
	if (isset($_POST['login'])){
		$login = $_POST['login'];
	}
	
	$name = $_POST['name'];
    $managerid = '0';
	if (isset($_POST['managerid'])){
	$managerid=$_POST['managerid'];
	}
	$department=$_POST['department'];
	$accountno=$_POST['accountno'];
	
	if (isset($_POST['ismanager'])){
	$ismanager = '1';
	}
	else{
	$ismanager = 0;
	}
	#echo $query;
	$query = "update employee set name='".$name."', department='".$department."', ismanager=".$ismanager." where login ='".$login."'";
	$result = @mysql_query($query);
	
	if(!$result){
	$msg = "Update operation failed.";
	}else{
	$msg = "Employee $login has been successfully Updated</b>";
    $managerslist = @mysql_query($managerquery);
	$employeeResult = @mysql_query($employeequery);
	$employee = mysql_fetch_assoc($employeeResult);
	}

}
#$_SESSION['empid']=null;
mysql_close($link);
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <table>
   <tr><td>Employee Name</td><td><input type="text" name="name" value="<?php echo $employee['name']?>"></td></tr>
   <tr><td>Login</td><td><input type="text" name="login" value="<?php echo $employee['login']?>" readonly ></td></tr>
   <tr><td>Manager's Names</td><td><select name="managerid">
   <option value="">NA</option>
   <?php
   
   if ($managerslist){
   while ($row = mysql_fetch_assoc($managerslist)){
   echo "<option value=".$row['emp_id'].">".$row['name']."</option>";
   }
   }
	?> 
</select></td></tr>

   <tr><td>Department name</td><td><input type="text" name="department" value="<?php echo $employee['department']?>"></td></tr>
   <tr><td>SSN No</td><td><input type="number" name="accountno" value="<?php echo $employee['ssn']?>" readonly></td></tr>
   <tr><td>Manager</td><td><input type="checkbox" name="ismanager" value="1"></td></tr>
   <tr><td></td><td><input type="submit" name="updateemployee" value="Update Employee"></td></tr>
   </table>
</form>
<p class = "err"><?php
if(isset($_POST['updateemployee'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
</body>

</html>