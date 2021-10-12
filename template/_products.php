<?php
    // add the product to cart
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['product-addtocart']) || isset($_POST['proceedtobuy'])){
            $_SESSION['cartitems'] = $_SESSION['cartitems']+1;
          $sql = "INSERT INTO cart(email,item_id) VALUES(?,?);";
          $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: signup.php?error=sqlerror");
                        exit();
            }
            else{
              $email = $_SESSION['email'] ?? 'temp';
              mysqli_stmt_bind_param($stmt, "sd", $email, $_GET['item_id']);
              mysqli_stmt_execute($stmt);
              if(isset($_POST['proceedtobuy'])){
                  header("Location: cart.php");
                  exit();
              }
              else{
              header("Location: index.php");
              exit();
              }
            }
        }
      }
?>
<!--   product  -->

<section id="product" class="py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <img src="<?php echo $_GET['item_image']; ?>" alt="product" class="img-fluid">
                            <div class="form-row pt-4 font-size-16 font-baloo">
                                <div class="col">
                                    <form method='post'>
                                    <button type="submit" name="proceedtobuy" class="btn btn-danger form-control">Proceed to Buy</button>
                                    </form>
                                </div>
                                <div class="col">
                                <form method = "post">
                                    <input type="hidden" name="item_id" value="<?php echo $item['item_id']; ?>">
                                    <input type="hidden" name="email" value="<?php echo $_SESSION['email']; ?>">
                                    <button type="submit" name="product-addtocart" class="btn btn-warning form-control">Add to Cart</button>
                                </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 py-5">
                            <h5 class="font-baloo font-size-20"><?php echo $_GET['item_name']; ?></h5>
                            <small>by <?php echo $_GET['item_brand']; ?></small>
                            <div class="d-flex">
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                  </div>
                                  <a href="#" class="px-2 font-rale font-size-14">10 ratings</a>
                            </div>
                            <hr class="m-0">
                            <!---    product price       -->
                                <table class="my-3">
                                    <tr class="font-rale font-size-14">
                                        <td>M.R.P:</td>
                                        <td><strike>₹<?php printf("%.2f",$_GET['item_price']+2500.00);?></strike></td>
                                    </tr>
                                    <tr class="font-rale font-size-14">
                                        <td>Deal Price:</td>
                                        <td class="font-size-20 text-danger"><span>₹<?php printf("%.2f",$_GET['item_price']);?></span><small class="text-dark font-size-12">&nbsp;&nbsp;Inclusive of all taxes</small></td>
                                    </tr>
                                    <tr class="font-rale font-size-14">
                                        <td>You Save:</td>
                                        <td><span class="font-size-16 text-danger">₹2500.00</span></td>
                                    </tr>
                                </table>
                            <!---    !product price       -->

                             <!--    #policy -->
                                <div id="policy">
                                    <div class="d-flex">
                                        <div class="return text-center mr-5">
                                            <div class="font-size-20 my-2 color-second">
                                                <span class="fas fa-retweet border p-3 rounded-pill"></span>
                                            </div>
                                            <a href="#" class="font-rale font-size-12">10 Days <br> Replacement</a>
                                        </div>
                                        <div class="return text-center mr-5">
                                            <div class="font-size-20 my-2 color-second">
                                                <span class="fas fa-truck  border p-3 rounded-pill"></span>
                                            </div>
                                            <a href="#" class="font-rale font-size-12"> <br>Delivery</a>
                                        </div>
                                        <div class="return text-center mr-5">
                                            <div class="font-size-20 my-2 color-second">
                                                <span class="fas fa-check-double border p-3 rounded-pill"></span>
                                            </div>
                                            <a href="#" class="font-rale font-size-12">1 Year <br>Warranty</a>
                                        </div>
                                    </div>
                                </div>
                              <!--    !policy -->
                                <hr>

                            <!-- order-details -->
                                <div id="order-details" class="font-rale d-flex flex-column text-dark">
                                    <small>Delivery by : <?php $tom=strtotime("tomorrow");
                                                            $fd=strtotime("+4 Days");
                                                            echo date("M-d  -  ",$tom);
                                                            echo date("M-d",$fd); ?></small>
                                    <small>Sold by <a href="#">Poorvika Mobiles</a>(4.5 out of 5 | 10 ratings)</small>
                                    <small><i class="fas fa-map-marker-alt color-primary"></i>&nbsp;&nbsp;Deliver to Customer - 600012</small>
                                </div>
                             <!-- !order-details -->
                             <div class="row">
                                 <div class="col-6">
                                        <!-- color -->
                                            <div class="color my-3">
                                              <div class="d-flex justify-content-between">
                                                <h6 class="font-baloo">Colour:</h6>
                                                <div class="p-2 color-yellow-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                                <div class="p-2 color-primary-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                                <div class="p-2 color-second-bg rounded-circle"><button class="btn font-size-14"></button></div>
                                              </div>
                                            </div>
                                        <!-- !color -->
                                 </div>
                                 <div class="col-6">
                                   <!-- product qty section -->  
                                     <div class="qty d-flex">
                                         <h6 class="font-baloo">Qty</h6>
                                         <div class="px-4 d-flex font-rale">
                                             <button class="qty-up border bg-light" data-id="pro1"><i class="fas fa-angle-up"></i></button>
                                             <input type="text" data-id="pro1" class="qty_input border px-2 w-50 bg-light" disabled value="1" placeholder="1">
                                             <button data-id="pro1" class="qty-down border bg-light"><i class="fas fa-angle-down"></i></button>
                                         </div>
                                     </div>
                                    <!-- !product qty section -->  
                                 </div>
                             </div>

                            <!-- size -->
                                <div class="size my-3">
                                    <h6 class="font-baloo">Size :</h6>
                                    <div class="d-flex justify-content-between w-75">
                                        <div class="font-rubik border p-2">
                                            <button class="btn p-0 font-size-14">64 GB </button>
                                        </div>
                                        <div class="font-rubik border p-2">
                                            <button class="btn p-0 font-size-14">128 GB </button>
                                        </div>
                                        <div class="font-rubik border p-2">
                                            <button class="btn p-0 font-size-14">256 GB </button>
                                        </div>
                                    </div>
                                </div>
                            <!-- !size -->


                        </div>

                        <div class="col-12">
                            <h6 class="font-rubik">Product Description</h6>
                            <hr>
                            <p class="font-rale font-size-14">5.8-inch (14.7 cm) Super Retina XDR OLED display.
                              Water and dust resistant (4 meters for up to 30 minutes, IP68).
                              Triple-camera system with 12MP Ultra Wide, Wide, and Telephoto cameras; Night mode, Portrait mode, and 4K video up to 60fps.</p>
                            <p class="font-rale font-size-14">12MP TrueDepth front camera with Portrait mode, 4K video, and Slo-Mo.
                              Face ID for secure authentication and Apple Pay.
                              A13 Bionic chip with third-generation Neural Engine.
                              Fast charge with 18W adapter included.</p>
                        </div>
                    </div>
                </div>
            </section>
        <!--   !product  -->