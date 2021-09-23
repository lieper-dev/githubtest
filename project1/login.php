<?php
session_start();
include "db_conn.php";
if (isset($_POST['uname']) && isset($_POST['password'])){
	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;

	}
	$uname = validate($_POST['uname']);
	$password = validate($_POST['password']);
		if (empty($uname)) {
			header("location: index.php?error=user name is required");
			exit();
		}elseif (empty($password)) {
			header("location: index.php?error=password is required");
			exit();
		}else{
			$password = md5($password);
			$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$password'";

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result)===1) {
				$row = mysqli_fetch_assoc($result);
				if($row['user_name']=== $uname && $row['password']=== $password){
					$_SESSION['user_name'] = $row['user_name'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['id'] = $row['id'];
					header("location: home.php");
				exit();
					
				}else{
				header("location: index.php?error=incorrect user name or password");
				exit();
			} 
			}
			else{
				header("location: index.php?error=incorrect user name or password");
				exit();
			}
		}

}else{
	header("location: index.php");
	exit();

}