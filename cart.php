<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cart | glee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";

            include "connection.php";

            if (isset($_SESSION["u"])) {

                $user = $_SESSION["u"]["email"];

               

                $total = 0;
                $subtotal = 0;
                $shipping = 0;
            ?>



                <div class="col-12  mb-3">
                    <div class="row">
                        <hr style="height: 5px;" class=" bg-black" />

                        <div class="col-12  mb-2">
                            <div class="row">
                                <div class="offset-lg-4 col-12 col-lg-4">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                        </div>
                                        <div class="col-10 text-center">
                                            <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Cart</P>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr style="height: 5px;" class=" bg-black" />

                        <!-- <div class="col-12">
                            <div class="row">
                                <div class="offset-lg-2 col-12 col-lg-6 mb-3">
                                    <input type="text" class="form-control" placeholder="Search in Cart..." />
                                </div>
                                <div class="col-12 col-lg-2 mb-3 d-grid">
                                    <button class="btnSub">Search</button>
                                </div>
                            </div>
                        </div> -->



                        <?php

                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $user . "'");
                        $cart_num = $cart_rs->num_rows;

                        

                        if ($cart_num == 0) {
                        ?>
                            <!-- empty view -->
                            <div class="col-10  offset-1 ">
                                <div class="row">
                                    <div class="col-12 emptyView"></div>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-1 fw-bold mt-5">
                                            You have no items in your Cart yet.
                                        </label>
                                    </div>
                                    <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-5 mt-5">
                                        <a href="home.php" class=" btnMain fs-3 fw-semibold text-center">Start Shopping</a>
                                    </div>
                                </div>
                            </div>
                            <!-- empty view -->
                        <?php
                        } else {
                        ?>
                            <!-- products -->
                            <div class="col-10 offset-1 col-lg-5 bg-transparent">
                                <div class="row">

                                    <?php

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search ("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                        product.id=product_img.product_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["qty"]);
                                        

                                        $address_rs = Database::search ("SELECT `district_id` AS did FROM `user_has_address` INNER JOIN `city` ON 
                                    user_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                    city.district_district_id=district.district_id WHERE `user_email`='" . $user . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $ship = 0;

                                        if ($address_data["did"] == 2) {
                                            $ship = $product_data["delivery_fee_colombo"];
                                            $shipping = $shipping + $ship;
                                        } else {
                                            $ship = $product_data["delivery_fee_other"];
                                            $shipping = $shipping + $ship;
                                        }

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                    ?>
                                        <div class="card mb-3 mx-0 col-12 bg-transparent border border-1 border-dark">


                                            <div class="col-12 mt-3 mb-2">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <span class="fw-bold text-black- fs-6">Seller :</span>&nbsp;
                                                        <span class="fw-bold text-black- fs-6"><?php echo $seller; ?></span>&nbsp;
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class=" border border-dark ">

                                            <div class=" row">

                                                <div class="col-12 col-lg-3">

                                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="<?php echo $product_data["description"]; ?>" title="Product Description">
                                                        <img src="<?php echo $product_data["img_path"]; ?>" class="img-fluid rounded-start shadow">
                                                    </span>

                                                </div>

                                                <div class=" col-12 col-lg-8">

                                                    <div class="card-body">

                                                        <h3 class="card-title mb-3"><?php echo $product_data["title"]; ?></h3>

                                                        <span class="fw-bold text-black-75 mb-5">Colour : black</span> &nbsp; |

                                                        &nbsp; <span class="fw-bold text-black-75 mb-5">Condition : import</span>
                                                        <br>

                                                        <span class="fw-bold text-black-0 fs-5 mt-5">Price :</span>&nbsp;
                                                        <span class="fw-semibold fs-2 mt-5 mb-4 text">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                        <br>

                                                        <span class="fw-bold text-black- fs-5">Quantity :</span>
                                                        <input type="number" class="mt-3 border border-2 border-secondary fs-4 fw-semibold px-3 " 
                                                        value="<?php echo $cart_data["qty"]; ?>" onchange="changeQTY(<?php echo $cart_data['cart_id']; ?>);" id="qty_num">


                                                        <span class="fw-bold text-black- fs-5">Delivery Fee :</span>&nbsp;
                                                        <span class="fw-bold text-black fs-4">Rs.<?php echo $ship; ?>.00</span>

                                                    </div>
                                                </div>
                                            </div>






                                            <div class="col-md-12 mt-3 mb-3 text-warning text-bg-dark p-2">
                                                <div class="row">
                                                    <div class="col-6 col-md-6">
                                                        <span class="fw-bold fs-5">Requested Total <i class="bi bi-info-circle"></i></span>
                                                    </div>
                                                    <div class="col-6 col-md-6 text-end">
                                                        <span class="fw-bold fs-5">Rs.<?php echo ($product_data["price"] * $cart_data["qty"]) + $ship; ?>.00</span>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class=" card-body row ">

                                                <div class=" btnSub col-5 text-center m-auto">

                                                    <a class=" mb-2 fs-5 fw-semibold text-light" style="text-decoration: none;color: #070707;"
                                                    href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>'
                                                         >Buy Now</a>



                                                </div>

                                                <div class="btnMain col-5 text-center m-auto">

                                                    <a class=" mb-2 fs-5 fw-semibold " style="text-decoration: none;
                                                        color:white;" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);">Remove</a>

                                                </div>

                                            </div>
                                        </div>
                                    <?php

                                    }

                                    ?>

                                </div>
                            </div>

                            <!-- products -->

                            <!-- summary -->                            
                            <div class="col-12 col-lg-5">
                                <div class="row">

                                    <div class="col-12">
                                        <label class="form-label fs-3 fw-bold">Summary</label>
                                    </div>

                                    <div class="col-12">
                                        <hr />
                                    </div>
                                    

                                    <div class="col-6 mb-3">
                                        <span class="fs-6 fw-bold">items (<?php echo $cart_num; ?>)</span>
                                    </div>

                                    <div class="col-6 text-end mb-3">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $total; ?> .00</span>
                                    </div>

                                    
                                    

                                    <div class="col-6">
                                        <span class="fs-6 fw-bold">Shipping</span>
                                    </div>

                                    <div class="col-6 text-end">
                                        <span class="fs-6 fw-bold">Rs. <?php echo $shipping; ?> .00</span>
                                    </div>

                                    <div class="col-12 mt-3">
                                        <hr />
                                    </div>

                                    <div class="col-6 mt-2">
                                        <span class="fs-4 fw-bold">Total</span>
                                    </div>

                                    <?php $result = $total + $shipping; ?>

                                    <div class="col-6 mt-2 text-end">
                                        <span class="fs-4 fw-bold">Rs. </span>
                                        <span class="fs-4 fw-bold" id="total"><?php echo $result ?></span>
                                        <span class="fs-4 fw-bold">.00</span>

                                    </div>

                                    <div class="col-12 mt-3 mb-3 d-grid">

                                        <button class="btnMain fs-5 fw-bold mb-5" onclick="checkOut();">CHECKOUT</button>


                                        <!-- alert -->
                                        <div class=" bg-danger p-3 border rounded-4 mt-5 fs-5 fw-semibold text-center bg-opacity-75 border-1 border-danger d-none" id="msgdiv">
                                            Product removed from Cart
                                        </div>

                                    </div>



                                </div>
                            </div>
                            <!-- summary -->


                        <?php
                        }

                        ?>

                    </div>
                </div>
            <?php
            } else {

            ?>



                <div class=" min-vh-100">

                    <div class=" col-8 offset-2 align-center align-items-center justify-content-center mt-5   ">

                        <img src="resource/errorpic.png" alt="" class=" border rounded-circle col-4 offset-4 ">

                    </div>

                    <h1 class=" text-center mt-3"> <?php echo ("Please Login or Signup first.");  ?></h1>

                   

                </div>


            <?php
            }
            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>


    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>


    <script>
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl)
        })
    </script>
</body>

</html>