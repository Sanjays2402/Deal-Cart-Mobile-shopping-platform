<?php
    require('dbh.php');
    
    session_start();
    if(!isset($_SESSION['cartitems']) || isset($_GET['payment'])){
      $_SESSION['cartitems'] = 0;
    }
    //to get the number of cart items
    if (isset($_SESSION['email'])){
      $sql = "SELECT item_id FROM cart WHERE email=? ORDER BY cart_id DESC LIMIT ?";
      $stmt = mysqli_stmt_init($conn);
	    if(!mysqli_stmt_prepare($stmt,$sql)) {
		    header("Location: signin.php?error=sqlerror");
		    exit();
      }
      else{
      
        $email = $_SESSION['email'] ;
        mysqli_stmt_bind_param($stmt, "sd", $email,$_SESSION['cartitems']);
        mysqli_stmt_execute($stmt);
        $result= mysqli_stmt_get_result($stmt);
        $itemIdArray = array();
        
        while($itemId = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($itemIdArray,$itemId);
        }
        $_SESSION['cartitems'] = count($itemIdArray);
      }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deal Kart</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha256-UhQQ4fxEeABh4JrcmAJ1+16id/1dnlOEVCFOxDef9Lw=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha256-kksNxjDRxd/5+jGurZUJd1sdR2v+ClrCl3svESBaJqw=" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">

    <!-- chat bot -->
      <script>
  window.watsonAssistantChatOptions = {
      integrationID: "d09a27d5-3b7b-4a3f-844f-097fd63eb0ec", // The ID of this integration.
      region: "eu-gb", // The region your integration is hosted in.
      serviceInstanceID: "8445ccde-acb7-460f-89c0-6716c1a809d1", // The ID of your service instance.
      onLoad: function(instance) { instance.render(); }
    };
  setTimeout(function(){
    const t=document.createElement('script');
    t.src="https://web-chat.global.assistant.watson.appdomain.cloud/loadWatsonAssistantChat.js";
    document.head.appendChild(t);
  });
      </script>
    <!-- !chat bot -->
</head>
<body>

        <header id="header">
            <nav class="navbar navbar-expand-lg navbar-dark color-second-bg">
              
                <a class="navbar-brand" href="index.php">Deal Kart</a>
                <div class="collapse navbar-collapse" id="navbarNav"></div>
                
                
                <?php  if (isset($_SESSION['username'])) : ?>
                  <div class="font-rale font-size-14">
                    Hey! <?php echo $_SESSION['username']?> 
                    <a href="signin.php?logout=true" class="px-3 border-right border-left text-dark">Logout</a>
                  </div>

                <?php else : ?>
                  <div class="font-rale font-size-14">
                    <a href="signin.php" class="px-3 border-right border-left text-dark">Login</a>
                    <a href="signup.php" class="px-3 border-right border-left text-dark">Signup</a>
                    <!-- <a href="#" class="px-3 border-right text-dark">Whishlist (0)</a> -->
                  </div>
                <?php endif; ?>
              <form class="font-size-14 font-rale">
                <a href="cart.php" class="py-2 rounded-pill color-primary-bg">
                  <span class="font-size-16 px-2 text-white"><i class="fas fa-shopping-cart"></i></span>
                  <span class="px-3 py-2 rounded-pill text-dark bg-light"><?php echo $_SESSION['cartitems'];?></span>
                </a>
            </form>
            </div>
              </nav>
              
        </header>

        <main id="main-site">
