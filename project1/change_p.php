<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name']))
{

	include "db_conn.php";



	if (isset($_POST['op']) && isset($_POST['np']) && isset($_POST['c_np'])){
		function validate($data){
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;

		}
		$op = validate($_POST['op']);  //string 
		$np = validate($_POST['np']);  // string
	    $c_np = validate($_POST['c_np']);  // string

	    if (empty($op)) {
	    	header("location: change_password.php?error=0");
			exit();

		}elseif (empty($np)) {
			header("location: change_password.php?error=1");
			exit();

		}elseif (!empty($c_np) && ($np !== $c_np)) {
			header("location: change_password.php?error=2");
			exit();

	    }else{

	    	//hashing the password
	    	$op = md5($op);
	    	$np = md5($np);
	    	$id = $_SESSION['id'];

	    	$sql = "SELECT password
	    			FROM users
	    			WHERE id = '$id' AND password = '$op' ";

	    	$result = mysqli_query($conn, $sql);

	    	if (mysqli_num_rows($result) === 1) {
	    		
	    		$sql2 = "UPDATE users
	    				SET password='$np'
	    				WHERE id= '$id'" ;
	    		mysqli_query($conn, $sql2);
	    		header("location: change_password.php?success=Password Changed Successfully!");
			exit();
	    	}else{

	    		header("location: change_password.php?error=3");
			exit();
	    	}

	    }
} else {
		header("location: change_password.php");
		exit();
	}

} else {
	header("location: index.php");
	exit();
}

// Data types
// Error logging/printing (print / print_r / var_dump)

// ==
// ===