<?php
session_start();

$errors = [
0 => 'Old Password is required',
1 => 'New Password is required',
2 => 'Passwords don\'t match',
3 => 'Incorrect Password',
];

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
			<form action="change_p.php" method="post">
			<h2>CHANGE PASSWORD!</h2>
			<?php
			if (isset( $_GET['error'])) { ?>
				<p class="error"> <?php echo $errors[$_GET['error']]; ?> </p>
			<?php }?>

			<?php
			if (isset( $_GET['success'])) { ?>
				<p class="success"> <?php echo $_GET['success']; ?> </p>
			<?php }?>
			
			<label>Old Password</label>
			<input type="password" 
				   name="op" 
				   placeholder="Old Password"><br>

			<label>New Password</label>
			<input type="password"
			       name="np" 
			       placeholder="New Password"><br>

			<label>Confirm NewPassword</label>
			<input type="password"
			       name="c_np" 
			       placeholder="Confirm New Password"><br>

			<button type="submit">Change</button>
					

			<a href="home.php" class="ca">Home</a>          

		</form>
</body>
</html>
<?php
}else{
	header("location: index.php");
	exit();
}

?>