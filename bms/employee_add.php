<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>Add Employee Form</h1>
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
   
if(isset($_POST['submit'])) 
{ 
	$login = null;
	if (isset($_POST['login'])){
		$login = $_POST['login'];
	}
	$query = "select * from employee where login = '$login'";
	$result = @mysql_query($query);
	
	if(mysql_num_rows($result) == 0){
	
	
	
	$name = $_POST['name'];
    $managerid = '0';
	if (isset($_POST['managerid'])){
	$managerid=$_POST['managerid'];
	}
	$department=$_POST['department'];
	$ssn=$_POST['ssn'];
	
	if (isset($_POST['ismanager'])){
	$ismanager = '1';
	}
	else{
	$ismanager = 0;
	}
	
	$query = "insert into employee (name, login, department, manager, isManager, ssn) 
	values ('$name', '$login', '$department', $managerid, $ismanager, $ssn);";
	//echo $query;
	$result = @mysql_query($query);
	if(!$result){
	$msg = "Invalid entry!";
	//echo $msg;
	}else{
	$msg = "Employee $name has been successfully added!</b>";
	//echo $msg;
    //echo "<br>You can use the following form again to enter a new name."; 
	$managerslist = @mysql_query($managerquery);
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
   <tr><td>Employee Name</td><td><input type="text" name="name"></td></tr>
   <tr><td>Login</td><td><input type="text" name="login"></td></tr>
   <tr><td>Manager's Names</td><td><select name="managerid">
   <option value="''">NA</option>
   <?php
   
   if ($managerslist){
   while ($row = mysql_fetch_assoc($managerslist)){
   echo "<option value=".$row['emp_id'].">".$row['name']."</option>";
   }
   }
	?> 
	</td></tr>
</select>
   <tr><td>Department name</td><td><input type="text" name="department"></td></tr>
   <tr><td>SSN</td><td><input type="text" name="ssn"></tr>
   <tr><td>Manager</td><td><input type="checkbox" name="ismanager" value="1"></td></tr>
   <tr><td></td><td><input type="submit" name="submit" value="Add Employee"></td></tr>
   <input type="hidden" name="submitted" value="no">
   <table>
</form>
<p class = "err"><?php
if(isset($_POST['submit'])){ 
	echo $msg;
	}
?>
<?php require_once('footer.php') ?>
</div>
<body>
</html>
