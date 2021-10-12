<?php


if(isset($_POST['signin'])){
	
	require "dbh.php";
	
	$email = $_POST['email'];
	$pwd= $_POST['password'];
	
	if(empty($email) || empty($pwd)){
		header("Location: signin.php?error=emptyfields");
		exit();
	}
	else {
		$sql = "SELECT * FROM user WHERE email=?;";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt,$sql)) {
			header("Location: signin.php?error=sqlerror");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "s" , $email);
			mysqli_stmt_execute($stmt);
			$result= mysqli_stmt_get_result($stmt);
			
			if($row = mysqli_fetch_assoc($result)){
				$hashedpwd= $row['password'];
				$pwdcheck = password_verify($pwd ,$hashedpwd);
				if($pwdcheck == false){
					header("Location: signin.php?error=wrongpassword");
					exit();
				}
				else if($pwdcheck == true){
					
					session_start();
					$_SESSION['login'] = true;
					$_SESSION['username'] = $row['username'];
					$_SESSION['email'] = $row['email'];
					
					//checking whether the user has added products to cart already
					if(isset($_SESSION['cartitems']) && $_SESSION['cartitems']>0){
						$sql = "UPDATE cart SET email=? WHERE email='temp' ORDER BY cart_id DESC LIMIT ? ";
						$stmt = mysqli_stmt_init($conn);
						if(!mysqli_stmt_prepare($stmt,$sql)){
							header("Location: signin.php?error=sqlerror");
							exit();
						}
						else{
							mysqli_stmt_bind_param($stmt, "sd", $_SESSION['email'], $_SESSION['cartitems']);
							mysqli_stmt_execute($stmt);
						}
					}

					header("Location: index.php");
					exit();
				}
				else{
					header("Location: signin.php");
				}
			}
			else{
			    header("Location: signin.php?error=non-existing-user");
			    exit();
			}	
		}
	}
}
else{
	header("Location: signin.php");
	exit();
}
?>