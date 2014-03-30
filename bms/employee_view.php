<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Employee home page</title>
</head>

<body>
<div>
<h1>View Employees</h1>
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

$employeequery = "SELECT * from employee";
#$employeequery = "SELECT  from employee e1, employee e2 where e1.emp_id = e2.manager";
$employeeslist = @mysql_query($employeequery);
if(isset($_POST['update'])) { 
	if (isset($_POST['select'])){
		$_SESSION['empid'] = $_POST['select'];
		header("location: employee_update.php");
	}
	else{
		$msg = "no rows selected";
	}
#include 'employee_update.php';
}
if(isset($_POST['delete'])) {
	if (isset($_POST['select'])){
		$query = "DELETE FROM employee WHERE emp_id=".$_POST['select'];
		$result = @mysql_query($query);
		if ($result){
			$msg = "Sucessfully deleted employee id ".$_POST['select'];
			$employeeslist = @mysql_query($employeequery);
		}
	}
	else{
		$msg = "No rows selected";
	}
}


echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<table>";
echo "<tr><th>Select<th>Employee ID<th>Name <th>Login <th> Mananger Name <th> SSN No</tr>";
  while ($row = mysql_fetch_assoc($employeeslist)){
  $query="select name from employee where emp_id=".$row['manager'];
  if ($result1 = @mysql_query($query)){
	$managerResult = mysql_fetch_assoc($result1);
  
  
   echo "<tr><td><input type='radio' name='select' value='".$row['emp_id']."'><td>".$row['emp_id']."<td>".$row['name']."<td>".$row['login']."<td>".$managerResult['name']."<td>".$row['ssn'];
  }
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
