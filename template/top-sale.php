<?php
  // fetch products from database
  $sql = "SELECT * FROM product";
  $stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)) {
		header("Location: signin.php?error=sqlerror");
		exit();
  }
  else{
    mysqli_stmt_execute($stmt);
    $result= mysqli_stmt_get_result($stmt);
    
    $resultArray = array();

    while($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      array_push($resultArray,$item);
    }
    shuffle($resultArray);
  }
  // add the product to cart
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['new-phones-submit'])){
      $_SESSION['cartitems'] = $_SESSION['cartitems']+1;
      $sql = "INSERT INTO cart(email,item_id) VALUES(?,?);";
      $stmt = mysqli_stmt_init($conn);
				if(!mysqli_stmt_prepare($stmt, $sql)){
					header("Location: signup.php?error=sqlerror");
					exit();
        }
        else{
          $email = $_SESSION['email'] ?? 'temp';
          mysqli_stmt_bind_param($stmt, "sd", $email, $_POST['item_id']);
          mysqli_stmt_execute($stmt);
          header("Location: ".$_SERVER['PHP_SELF']);
          exit();
        }
    }
  }

?>

<!-- New Phones -->
<section id="new-phones">
            <div class="container">
              <h4 class="font-rubik font-size-20">Top Sale</h4>
              <hr>

                    <!-- owl carousel -->
                    <div class="owl-carousel owl-theme">
                    <?php foreach ($resultArray as $item){?>
                      <div class="item py-2 bg-light">
                        <div class="product font-rale">
                        <?php echo "<a href='product.php?".http_build_query($item)."'>" ?><img src="<?php echo $item['item_image']; ?>" alt="product1" class="img-fluid"></a>
                          <div class="text-center">
                            <h6><?php echo $item['item_name']; ?></h6>
                            <div class="rating text-warning font-size-12">
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="fas fa-star"></i></span>
                              <span><i class="far fa-star"></i></span>
                            </div>
                            <div class="price py-2">
                              <span>₹<?php echo $item['item_price'];?></span>
                            </div>
                            <form method = "post">
                              <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                              <input type="hidden" name="email" value="<?php echo $_SESSION['email'] ?? 'temp'; ?>">
                              <button type="submit" name="new-phones-submit" class="btn btn-warning font-size-12">Add to Cart</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    <?php } ?>
                      
                    </div>
                  <!-- !owl carousel -->

            </div>
          </section>
          <!-- !New Phones -->