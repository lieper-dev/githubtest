<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>Hello! <?php echo $_SESSION['name']; ?></h1>
	<nav class="home_nav">
		<a href="change_password.php">Change Password!</a>
	    <a href="logout.php">Logout</a>
	</nav> 
	
</body>
</html>
<?php
}else{
	header("location: index.php");
	exit();
}

?>