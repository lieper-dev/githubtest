<?php
session_start();
include "db_conn.php";



if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['con_password'])){
	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;

	}
	$uname = validate($_POST['uname']);
	$password = validate($_POST['password']);
	$con_password = validate($_POST['con_password']);
	$name = validate($_POST['name']);
	$user_data = 'uname='. $uname. '&name='. $name;


		if (empty($uname)) {
			header("location: signup.php?error=user name is required&$user_data");
			exit();
		}else if (empty($password)) {
			header("location: signup.php?error=password is required&$user_data");
			exit();
		}
		else if (empty($con_password)) {
			header("location: signup.php?error=confirm your password&$user_data");
			exit();
		}
		else if (empty($name)) {
			header("location: signup.php?error=name is required&$user_data");
			exit();
		}
		else if ($password !== $con_password) {
			header("location: signup.php?error=passwords doesn't match&$user_data");
			exit();
		}


		else{

			//hashing the password
			$password = md5($password);
			$sql = "SELECT * FROM users WHERE user_name='$uname'";

			$result = mysqli_query($conn, $sql);

			if (mysqli_num_rows($result) > 0) {
			header("location: signup.php?error=user name already exsists try different one&$user_data");
			exit();
		}
			else{
				$sql2 = "INSERT INTO users(user_name, password, name) VALUES('$uname', '$password', '$name')";
				$result2 = mysqli_query($conn, $sql2);
				if ($result2) {
					header("location: signup.php?success=Account Created Successfully!&$user_data");
			exit();
				}else
				{
					$error = mysqli_error($conn);
					header("location: signup.php?error={$error}&$user_data");
			exit();
				}
			}
			}
			
		}


else{
	header("location: signup.php");
	exit();

}