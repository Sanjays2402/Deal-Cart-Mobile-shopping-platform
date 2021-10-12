<?php 
    //to check out checking whether the user has logged in or not
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['proceed-to-buy'])){
            if(isset($_SESSION['email'])){
                header("Location: payment.php");
                exit();
            }
            else{
                header("Location: signin.php?error=not_loggedin");
                exit();
            }
        }
    }
    // to delete cart item
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['delete-cart-submit'])){
            $_SESSION['cartitems'] = $_SESSION['cartitems']-1;
            $sql = "DELETE FROM cart WHERE item_id=? ORDER BY cart_id DESC LIMIT 1";
            $stmt = mysqli_stmt_init($conn);
	        if(!mysqli_stmt_prepare($stmt,$sql)) {
		        header("Location: signin.php?error=sqlerror");
		        exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "d", $_POST['delete_item_id']);
                mysqli_stmt_execute($stmt);
                header("Location: cart.php");
                exit();
            }
        }
    }
    $sum=0;
    // display the products added to the cart
    $sql = "SELECT item_id FROM cart WHERE email=? ORDER BY cart_id DESC LIMIT ?";
    $stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt,$sql)) {
		header("Location: signin.php?error=sqlerror");
		exit();
    }
    else{
        $email = $_SESSION['email'] ?? 'temp';
        mysqli_stmt_bind_param($stmt,"sd",$email,$_SESSION['cartitems']);
        mysqli_stmt_execute($stmt);
        $result= mysqli_stmt_get_result($stmt);
        
        $itemIdArray = array();
        
        while($itemId = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($itemIdArray,$itemId);
        }
        $resultArray = array();

        foreach ($itemIdArray as $itemId){
            $sql = "SELECT * FROM product WHERE item_id =?";
            $stmt = mysqli_stmt_init($conn);
	        if(!mysqli_stmt_prepare($stmt,$sql)) {
		        header("Location: signin.php?error=sqlerror");
		        exit();
            }
            else{
                mysqli_stmt_bind_param($stmt, "d" , $itemId['item_id']);
			    mysqli_stmt_execute($stmt);
                
                $result= mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $sum += $row['item_price'];
                array_push($resultArray,$row);
            }
        }
        shuffle($resultArray);
    }
    
?>

<!-- Shopping cart section  -->
<section id="cart" class="py-3">
                    <div class="container-fluid w-75">
                        <h5 class="font-baloo font-size-20">Shopping Cart</h5>

                        <!--  shopping cart items   -->
                            <div class="row">
                                <div class="col-sm-9">
                                    <?php foreach($resultArray as $item): ?>
                                    <!-- cart item -->
                                    <div class="row border-top py-3 mt-3">
                                            <div class="col-sm-2">
                                                <img src="<?php echo $item['item_image']; ?>" style="height: 120px;" alt="cart1" class="img-fluid">
                                            </div>
                                            <div class="col-sm-8">
                                                <h5 class="font-baloo font-size-20"><?php echo $item['item_name'];?></h5>
                                                <small>by <?php echo $item['item_brand'];?></small>
                                                <!-- product rating -->
                                                <div class="d-flex">
                                                    <div class="rating text-warning font-size-12">
                                                        <span><i class="fas fa-star"></i></span>
                                                        <span><i class="fas fa-star"></i></span>
                                                        <span><i class="fas fa-star"></i></span>
                                                        <span><i class="fas fa-star"></i></span>
                                                        <span><i class="far fa-star"></i></span>
                                                      </div>
                                                      <a href="#" class="px-2 font-rale font-size-14"><?php echo rand(1000,25000); ?> ratings</a>
                                                </div>
                                                <!--  !product rating-->

                                                <!-- product qty -->
                                                    <div class="qty d-flex pt-2">
                                                        <div class="d-flex font-rale w-25">
                                                            <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                                            <input type="text" data-id="pro1" class="qty_input border px-2 w-100 bg-light" disabled value="1" placeholder="1">
                                                            <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                                                        </div>
                                                        <form method = 'post'>
                                                        <input type='hidden' value="<?php echo $item['item_id']; ?>" name="delete_item_id">
                                                        <button type="submit" name='delete-cart-submit' class="btn font-baloo text-danger px-3 border-right">Delete</button>
                                                        </form>
                                                        <button type="submit" class="btn font-baloo text-danger">Save for Later</button>
                                                    </div>
                                                <!-- !product qty -->

                                            </div>

                                            <div class="col-sm-2 text-right">
                                                <div class="font-size-20 text-danger font-baloo">
                                                    ₹<span class="product_price"><?php echo $item['item_price'];?></span>
                                                </div>
                                            </div>
                                    </div>
                                    <?php endforeach; ?>
                                    <!-- !cart item -->
                                </div>
                                <!-- subtotal section-->
                                <div class="col-sm-3">
                                    <div class="sub-total border text-center mt-2">
                                        <h6 class="font-size-12 font-rale text-success py-3"><i class="fas fa-check"></i> Your order is eligible for FREE Delivery.</h6>
                                        <div class="border-top py-4">
                                            <h5 class="font-baloo font-size-20">Subtotal (<?php echo count($resultArray);?> item):&nbsp; <span class="text-danger">₹<span class="text-danger" id="deal-price"><?php printf("%.2f",$sum);?></span> </span> </h5>
                                            <?php if ($sum>0): ?>
                                            <form method = 'post'>
                                                <button type="submit" name="proceed-to-buy" class="btn btn-warning mt-3">Proceed to Buy</button>
                                            </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- !subtotal section-->
                            </div>
                        <!--  !shopping cart items   -->
                    </div>
                </section>
            <!-- !Shopping cart section  -->