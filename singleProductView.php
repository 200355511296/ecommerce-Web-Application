<?php

include "connection.php";


$pid = $_GET["id"];


if (isset($pid)) {

    $p_rs=Database::search("SELECT * 
    FROM product" );

    $p_data = $p_rs->fetch_assoc();



    $product_rs = Database::search("SELECT product.price,product.price, product.qty, product.description, product.title, datetime_added, 
product.delivery_fee_colombo, product.delivery_fee_other, clr_name, product.category_cat_id 
FROM product 
INNER JOIN product_has_color ON product.id = product_has_color.product_id 
INNER JOIN color ON product_has_color.color_clr_id = color.clr_id 
WHERE product.id = '" . $pid . "';");


    $product_data = $product_rs->fetch_assoc();

?>



    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title> Singal View| glee</title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

    </head>

    <body>


        <div class="container-fluid">
            <div class="row">

                <?php include "header.php"; ?>

                <div class="col-12 mt-0 bg-white singleProduct " style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">
                    <div class="row">
                        <div class="col-12" style="padding: 10px;">
                            <div class="row">

                                <div class="col-12 col-lg-2 order-2 order-lg-1">
                                    <ul>

                                        <?php
                                        $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                        $image_num = $image_rs->num_rows;
                                        $img = array();

                                        if ($image_num != 0) {
                                            for ($x = 0; $x < $image_num; $x++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$x] = $image_data["img_path"];
                                        ?>
                                                <li class="d-flex flex-column justify-content-center align-items-center 
                                                     mb-1">
                                                    <img src="<?php echo $img[$x]; ?>" class="img-thumbnail mt-1 mb-1" id="productImg<?php echo $x; ?>" onpointermove="loadMainImg(<?php echo $x; ?>);" />
                                                </li>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                                 border-1 border-secondary mb-1">
                                                <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                                    border border-1 border-secondary mb-1">
                                                <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                            </li>
                                            <li class="d-flex flex-column justify-content-center align-items-center 
                                                    border border-1 border-secondary mb-1">
                                                <img src="resource/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                            </li>
                                        <?php
                                        }
                                        ?>


                                    </ul>
                                </div>

                                <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                    <div class="row">
                                        <div class="col-12 align-items-center ">
                                            <div class="mainImg" id="mainImg"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center  mb-4">

                                    <h2 class="h2 text-dark fw-bold">Singal Product View</h2>

                                </div>

                                <div class="col-12 col-lg-6 order-3">

                                    <div class="row">

                                        <div class="col-12">

                                            <div class="row">

                                            </div>

                                            <div class="row">
                                                <div class="col-12 my-2 mb-5">
                                                    <span class="fs-4 fw-bold text-dark"><?php echo $product_data["title"]; ?></span>
                                                </div>
                                            </div>

                                            <!-- <div class="row ">
                                                <div class="col-12 my-2 mb-5">
                                                    <span class="badge">
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>
                                                        <i class="bi bi-star-fill text-warning fs-5"></i>

                                                        &nbsp;&nbsp;&nbsp;

                                                        <label class="fs-5 text-dark fw-bold">4.5 Stars | 39 Reviews and Ratings</label>
                                                    </span>
                                                </div>
                                            </div> -->

                                            <?php

                                            $price = $product_data["price"];
                                            $adding_price = ($price / 100) * 10;
                                            $new_price = $price + $adding_price;
                                            $difference = $new_price - $price;

                                            ?>

                                            <div class="row ">
                                                <div class="col-12 ">
                                                    <span class="fs-3 text-danger fw-bold">Rs. <?php echo $price; ?> .00</span>
                                                    &nbsp;&nbsp; | &nbsp;&nbsp;

                                                    <span class="fs-4 text-dark fw-bold" style="text-decoration: line-through;text-decoration-color: red;hei">Rs. <?php echo $new_price; ?> .00</span>
                                                    &nbsp;&nbsp; | &nbsp;&nbsp;
                                                    <span class="fs-4 fw-bold text-black-75">Save Rs. <?php echo $difference; ?> .00 (10%)</span>
                                                </div>
                                            </div>

                                            <div class="row ">
                                                <div class="col-12 my-2">
                                                    <span class="fs-5 text-dark"><b>Warrenty : </b>3 Month Warrenty</span><br />
                                                    <span class="fs-5 text-dark"><b>Return Policy : </b>1 Month Return Policy</span><br />
                                                    <span class="fs-5 text-dark"><b>In Stock : </b> <?php echo $product_data["qty"]; ?> Items Available</span>
                                                </div>
                                            </div>



                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="my-2 offset-lg-2 col-12 col-lg-8 border border-2 border-danger rounded mb-5">
                                                            <div class="row">
                                                                <div class="col-3 col-lg-2 border-end border-2 border-danger ">
                                                                    <i class="bi bi-tag-fill h1"></i>
                                                                </div>
                                                                <div class="col-9 col-lg-10">
                                                                    <span class="fs-5 text-danger fw-bold">
                                                                        Stand a chance to get 5% discount by using VISA or MASTER
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-12">

                                                    <div style="height: 60px;">

                                                        <div class="col-12 d-none" id="msgdiv1">

                                                            <div class="alert alert-danger text-dark" role="alert" id="msg1">
                                                                Minimum quantity has achieved.
                                                            </div>

                                                        </div>

                                                        <div class="col-12 d-none" id="msgdiv2">

                                                            <div class="alert alert-danger text-dark" role="alert" id="msg2">
                                                                Maximum quantity has achieved
                                                            </div>

                                                        </div>



                                                    </div>




                                                    <div class="row">
                                                        <div class="col-12 my-2">
                                                            <div class="row g-2">

                                                                <div class="border border-1 border-secondary p-1 rounded overflow-hidden 
                                                                    float-left mt-1 position-relative product-qty">

                                                                    <div class="col-12">

                                                                        <span class=" fs-3">Quantity : </span>

                                                                        <input onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' type="text" class="border-0 fs-3 fw-bold text-start bg-transparent p-1 m-auto " value="1" id="qty_input" />

                                                                        <div class="position-absolute qty-buttons">
                                                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                         qty-inc">
                                                                                <i class="bi bi-caret-up-fill text-secondary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                            </div>
                                                                            <div class="justify-content-center d-flex flex-column align-items-center 
                                                                         qty-dec">
                                                                                <i class="bi bi-caret-down-fill text-secondary fs-5" onclick="qty_dec();"></i>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-12 mt-5">
                                                                        <div class="row">
                                                                            <div class="col-4 d-grid">
                                                                                <button class="btnSub " onclick="payNow(<?php echo $pid; ?>);">Buy Now</button>
                                                                            </div>
                                                                            <div class="col-4 d-grid">
                                                                                <button class="btnMain" onclick="addToCart(<?php echo $p_data['id']; ?>);">Add To Cart</button>
                                                                            </div>
                                                                            <div class="col-4 d-grid">
                                                                                <button class="btn btn-secondary">
                                                                                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- <div class="col-12 bg-transparent">
                            <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark">
                                <div class="col-12">
                                    <span class="fs-3 fw-bold">Related Items</span>
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="col-12 bg-transparent">
                            <div class="row g-2">

                                <?php



                                $related_rs = Database::search("SELECT * FROM product 
                                   
                                    WHERE category_cat_id ='" . $product_data["category_cat_id"] . "' LIMIT 4");

                                $related_num = $related_rs->num_rows;
                                for ($y = 0; $y < $related_num; $y++) {

                                    $related_data = $related_rs->fetch_assoc();
                                ?>

                                    <div class=" col-3 mt-5 mb-5 bg-transparent">
                                        <div class="card" style="width: 18rem;">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>
                                                <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12  btnMain fw-semibold">Buy Now</a>

                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }

                                ?>
                            </div>
                        </div> -->

                        <!-- <div class="col-12 ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="row d-block me-0 mt-4 mb-3 border  border-1 border-dark ">
                                        <div class="col-12">
                                            <span class="fs-4 fw-bold">Product Details</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row d-block me-0 mt-4 mb-3  border  border-1 border-dark">
                                        <div class="col-12">
                                            <span class="fs-4 fw-bold">Feedbacks</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->


                        <div class="col-12 col-lg-6 bg-transparent justify-content-center mb-4">


                            <div>
                                <label class="form-label fs-4 fw-bold">Description : </label>
                            </div>
                            <div>
                                <textarea cols="60" rows="5" class="form-control" readonly>
                                            <?php echo $product_data["description"]; ?>

                                            </textarea>
                            </div>

                        </div>

                        <!-- <div class="col-12 col-lg-6 mt-4">
                            <div class="row border border-1 border-dark rounded overflow-scroll me-0" style="height: 300px;">

                            <?php

                                    $feedback_rs = Database::search("SELECT * FROM `feedback` INNER JOIN `user` ON 
                                feedback.user_email=user.email WHERE `product_id`='" . $pid . "'");

                                    $feedback_num = $feedback_rs->num_rows;

                                    for ($y = 0; $y < $feedback_num; $y++) {
                                        $feedback_data = $feedback_rs->fetch_assoc();

                                    ?>

                                <div class="col-12 mt-2 mb-2 mx-1">
                                    <div class="row border border-1 bg-light rounded me-0">

                                        <div class="col-10 mt-2 mb-1 ms-0"><?php echo $feedback_data["fname"]." ".$feedback_data["lname"]; ?></div>
                                        <div class="col-2 mt-2 mb-1 me-0">

                                             <?php

                                                if($feedback_data["type"] == 1){
                                                    ?><span class="badge bg-danger text-dark p-2">Positive</span><?php
                                                }else if($feedback_data["type"] == 2){
                                                    ?><span class="badge bg-warning text-dark  p-2">Neutral</span><?php
                                                }else if($feedback_data["type"] == 3){
                                                    ?><span class="badge bg-dark text-dark  p-2">Negative</span><?php
                                                }

                                                ?>
                                        </div>

                                        <div class="col-12">
                                            <b>
                                            <?php echo $feedback_data["feed"]; ?>
                                            </b>
                                        </div>
                                        <div class="offset-6 col-6 text-end">
                                            <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php

                                    }

                                    ?>
                            </div>
                        </div> -->

                    </div>
                </div>
                <?php include "footer.php" ?>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

    </body>

    </html>

<?php


} else {
    echo "Somthing went Wrong";
}
