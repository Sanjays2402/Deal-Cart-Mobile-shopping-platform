<?php
    session_start();
    if(isset($_SESSION['username']) && $_GET['logout']==true)
    {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['login']);
        header("Location: index.php");
    }
    

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign in Page </title>
        
        <link rel="stylesheet" href="signup-style.css"/>
        
    </head>
    <body>
     <div class="sign-up-form">
         <img src="./assets/signin.jpg" alt="sign-in-icon">
         <h1>Sign in</h1>
         <form action="signinphp.php" method="post">
			<?php
				if (isset($_GET['error'])) {
					if($_GET['error']=="emptyfields") {
						echo '<p class="signuperror"> Fill in all fields!</p>';
					}
					else if($_GET['error']=="wrongpassword") {
						echo '<p class="signuperror"> Incorrect Password!</p>';
					}
					else if($_GET['error']=="not_loggedin") {
					    echo '<p class="signuperror"> You should sign in first!</p>';
					}
					else if($_GET['error']=='non-existing-user'){
					    echo '<p class="signuperror"> Email not found!</p>';
					}
				}
			?>
            <input name="email" type="email" class="input-box" placeholder="Email">
             <input name="password" type="password" class="input-box" placeholder="Password ">
             <p><span><input type="checkbox"></span>Remember Me</p>
             <button name="signin" type="submit" class="signup-btn">Sign in</button>
             <hr>           
            <p>Don't have an account ?  <a href="signup.php">Sign up</a></p>
            <p>Return to <a href="index.php">main</a> page</p>
         </form>
     </div>
</body>
</html>