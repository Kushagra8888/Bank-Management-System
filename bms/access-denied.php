<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Access Denied</title>
<link href="/resources/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Access Denied </h1>
<p align="center">&nbsp;</p>
<h4 align="center" class="err">Access Denied!<br />
  You do not have access to this resource.<br/>
  <a href="index.php">Login again</a></h4>
  
  <?php
	//Start session
	session_start();
	
	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	unset($_SESSION['SESS_LOGIN']);
	unset($_SESSION['SESS_ROLE']);
	
	session_destroy();
	
?>

</body>
</html>
