<?php 

if (isset($_POST['signup'])){

	require 'dbh.php';
	
	$username = $_POST['name'];
	$umail = $_POST['email'];
	$upwd= $_POST['password'];
	$uconpwd = $_POST['cpassword'];
	
	if(empty($username) || empty($umail) || empty($upwd) || empty($uconpwd) ) {
	header("Location: signup.php?error=emptyfields");
	exit();
	}
	else if(!filter_var($umail,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z]*$/",$username)){
	header("Location: signup.php?error=invalidmail&invalidname");
	exit();
	}
	else if(!filter_var($umail,FILTER_VALIDATE_EMAIL)){
	header("Location: signup.php?error=invalidmail");
	exit();
	}
	else if(!preg_match("/^[a-zA-Z]*$/",$username)){
		header("Location: signup.php?error=invalidname");
		exit();
	}
	else if($upwd != $uconpwd) {
		header("Location: signup.php?error=checkpassword");
		exit();
	}
	else{
		$sql= "SELECT username,email FROM user WHERE username=? and email=?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)){
			header("Location: signup.php?error=sqlerrorb");
			exit();
		}
		else{
			mysqli_stmt_bind_param($stmt,"ss",$username,$umail);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultcheck = mysqli_stmt_num_rows($stmt);
			if($resultcheck > 0 ){
				header("Location: signup.php?error=nametaken");
				exit();
			}
			else{
				$sql= "INSERT INTO user (username,email,password) VALUES (?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: signup.php?error=sqlerror");
					exit();
				}
				else{
					$hashedpwd = password_hash($upwd, PASSWORD_DEFAULT);
					mysqli_stmt_bind_param($stmt, "sss", $username, $umail, $hashedpwd);
					mysqli_stmt_execute($stmt);
					header("Location: signin.php?signup=success");
					exit();
				}
			}
		}
	}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
else{
	header("Location: signup.php");
	exit();
}