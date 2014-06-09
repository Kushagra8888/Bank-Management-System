<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Admin Home Page</title>

</head>



<?php
require_once('auth.php');
require_once("config.php");
?>

<body>


<div>
<header>
	<h1>Welcome!</h1>
</header>
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

<img src="resources/img/business.jpg"  width=100% height="300">

<h2>Bank Management System</h2>
<br>
<p>
	This system is designed to ensure easy, secure and error-free administration and maintenance of a bank database. It consists of four key modules,
	Employee, Customer, Accounts and Transactions. The employee module holds information about bank employees such as their name, loginID, SSN no., 
	Manager names etc. The Customer module holds details of bank customer such as their name, phone no. addresss, and email. The accounts module 
	stores details of each account opened in the bank including its owner, date of opening, balance and type of account. Finally the transactions module
	holds all transaction details, their type, mode, amount and the account no. on which the transaction was performed.
</p>
<p>
	The administrator can add new employees, customers and accounts in the database.New transactions cannot be added by the administrator as it can 
	lead to incosistency. This functionality will typically be implemented by a client side application. He can view information already stored about
	employees, customers, accounts and transaction. He can also modify or delete 
	employees and customers. Accounts cannot be modified but they can be deleted. 
</p>
<br>
<br>
</div>
</body>
</html>