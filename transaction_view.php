<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<title>Transactions home page</title>
</head>

<body>
<div>
<h1>View Transactions</h1>
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
//Import configuration files
require_once('auth.php');
require_once("config.php");

//Establish connection
$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
$db = mysql_select_db(DB_NAME);
$transactionsquery = "SELECT * from transactions";
$transactionslist = @mysql_query($transactionsquery);

echo "<form method='post' action=".$_SERVER['PHP_SELF'].">";
echo "<table>";
echo "<tr><th>Account no<th>Transaction ID<th>Type<th>Mode<th>Amount<th>Date</tr>";
  while ($row = mysql_fetch_assoc($transactionslist)){
   echo "<tr><td>".$row['accountno']."<td>".$row['transaction_id']."<td>".$row['type']."<td>".$row['mode']."<td>".$row['amount']."<td>".$row['date'];
  }
   ?>
</table>   
</form>

<?php require_once('footer.php') ?>
</div>
</body>
</html>