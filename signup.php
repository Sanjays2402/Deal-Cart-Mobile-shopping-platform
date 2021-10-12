<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up Page </title>
        
		<link rel="stylesheet" href="signup-style.css"/>
		
    </head>
    <body>
     <div class="sign-up-form">
         <img src="./assets/signup.jpg" alt="sign-up-icon">
         <h1>Sign Up</h1>
		  <?php
		    if (isset($_GET['error'])) {
				if($_GET['error']=="emptyfields") {
				echo '<p class="signuperror"> Fill in all fields!</p>';
				}
				else if($_GET['error']=="invalidmail&invalidname") {
				echo '<p class="signuperror"> Invalid mail id & Name!</p>';
				}
				else if($_GET['error']=="invalidmail") {
				echo '<p class="signuperror"> Invalid mail id!</p>';
				}
				else if($_GET['error']=="invalidname") {
				echo '<p class="signuperror"> Invalid Name!</p>';
				}
				else if($_GET['error']=="checkpassword") {
				echo '<p class="signuperror"> Passwords do not match!</p>';
				}
				else if($_GET['error']=="nametaken") {
					echo '<p class="signuperror"> Name and email already taken!</p>';
				}
			}
		  ?>
         <form action="signupphp.php" method="POST">
             <input name="name" type="text " class="input-box" placeholder="Enter Your Name">
             <input name="email" type="email" class="input-box" placeholder="Email">
             <input name="password" type="password" class="input-box" placeholder="Password ">
             <input name="cpassword" type="password" class="input-box" placeholder="Confirm Password">
             <p><span><input type="checkbox"></span>I Agree to the <a href="#">Terms & Conditions</a></p>
             <button type="submit" class="signup-btn" name="signup">Sign up</button>
             <hr>
             <p class="or">OR</p>
            
             <p>Already have an account ?  <a href="signin.php">Sign in</a></p>
             <p>Return to <a href="index.php">main</a> page</p>
         </form>
      </div>
    </body>
</html>