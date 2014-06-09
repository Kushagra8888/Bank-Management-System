<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Transactions home page</title>
</head>

<?php
//Import configuration files
require_once('auth.php');
require_once("config.php");

//Establish connection
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db(DB_NAME);
$deparmentsquery = "SELECT * from departments";
$departmentslist = @mysql_query($departmentssquery);

echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<table>";
echo "<tr><th>department No.</th><th>Department Name</th></tr>";
  while ($row = mysql_fetch_assoc($departmentslist)){
   echo "<tr><td>".$row['dept_no']."<td>".$row['name'];
  }
   ?>
</table>   
</form>
<?php require_once('footer.php') ?>
</html>