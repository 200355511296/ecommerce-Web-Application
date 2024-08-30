<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Purchasing History | glee</title>

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

                $mail = $_SESSION["u"]["email"];

                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $mail . "'");
                $invoice_num = $invoice_rs->num_rows;

            ?>

                <div class="col-12  mb-2">
                    <div class="row">
                        <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                </div>
                                <div class="col-10 text-center">
                                    <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Purchasing History</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php

                if ($invoice_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-12 text-center " style="height: 450px;" id="cardnon">
                        <span class="fs-1 fw-bold  d-block" style="margin-top: 200px;">
                            You have not purchased any item yet...
                        </span>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <!-- Have Product -->
                    <div class="col-12" id="cardin">

                        <div class="row">

                            <div class="col-10 offset-1 d-none d-lg-block">
                                <div class="row text-center fs-5 ">
                                    <div class="col-1 ">
                                        <label class="form-label fw-bold">#</label>
                                    </div>
                                    <div class="col-3 ">
                                        <label class="form-label fw-bold">Order Details</label>
                                    </div>
                                    <div class="col-1 text-end">
                                        <label class="form-label fw-bold">Quantity</label>
                                    </div>
                                    <div class="col-2 text-end">
                                        <label class="form-label fw-bold">Amount</label>
                                    </div>
                                    <div class="col-2 text-end">
                                        <label class="form-label fw-bold">Purchased Date & Time</label>
                                    </div>
                                    <div class="col-3"></div>
                                    <div class="col-12">

                                    </div>
                                    <hr class=" text-dark h1">
                                </div>
                            </div>

                            <!-- card rows -->

                            <?php

                            for ($x = 0; $x < $invoice_num; $x++) {
                                $invoice_data = $invoice_rs->fetch_assoc();

                            ?>
                                <div class="col-10 offset-1"  >
                                    <div class="row">

                                        <div class="col-12 col-lg-1 bg-transparent text-center text-lg-start">
                                            <label class="form-label text-dark fs-5 py-5"><?php echo $invoice_data["invoice_id"]; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-3 ">
                                            <div class="row bg-transparent">
                                                <div class="card mx-0 mx-lg-3 my-3 bg-transparent border bor0" style="max-width: 540px;">
                                                    <div class="row g-0 ">
                                                        <div class="col-md-4">

                                                            <?php

                                                            $details_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON 
                                                        product.id=product_img.product_id INNER JOIN `user` ON product.user_email=user.email 
                                                        WHERE `id`='" . $invoice_data["product_id"] . "'");

                                                            $product_data = $details_rs->fetch_assoc();

                                                            ?>

                                                            <img src="<?php echo $product_data["img_path"]; ?>" class="img-thumbnail rounded-start mt-3" />
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="card-body">

                                                                <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>
                                                                <p class="card-text"><b>Seller : </b>
                                                                    <?php echo $product_data["fname"] . " " . $product_data["lname"]; ?>
                                                                </p>
                                                                <p class="card-text"><b>Price : </b>Rs. <?php echo $product_data["price"]; ?> .00</p>

                                                               

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-1 text-center text-lg-end">
                                            <label class="form-label fs-4 py-5"><?php echo $invoice_data["qty"]; ?></label>
                                        </div>

                                        <div class="col-12 col-lg-2 text-center text-lg-end ">
                                            <label class="form-label fs-5 py-5 text-dark fw-semibold">Rs. <?php echo $invoice_data["total"]; ?> .00</label>
                                        </div>
                                        <div class="col-12 col-lg-2 text-center text-lg-end">
                                            <label class="form-label fs-5 px-3 py-5"><?php echo $invoice_data["date"]; ?></label>
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <div class=" mt-5 ms-3">
                                                <!-- <div class="col-6 d-grid">
                                                    <button class="btnSub mt-5 fs-5" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                    <button class="btnSub mt-5 fs-5" >
                                                        <i class="bi bi-info-circle-fill"></i> Feedback
                                                    </button>
                                                </div> -->

                                                <!-- remove -->
                                               
                                                <!-- <div class="col-6 d-grid" onclick="remove();">
                                                    <button class="btnMain rounded mt-5 " >
                                                        <i class="bi bi-trash3-fill text-light"></i>
                                                    </button>
                                                </div> -->

                                                <!-- <div class="col-6 d-grid" onclick="window.location = 'invoice.php'">
                                                    <button class="btnMain rounded mt-5 " >
                                                        <i class="bi bi-trash3-fill text-light"></i>
                                                    </button>
                                                </div> -->

                                               
                                                <?php 
                                                                $i_rs = Database::search("SELECT 	`status` FROM invoice INNER JOIN product ON invoice.product_id = product.id WHERE id='" . $invoice_data["product_id"] . "'");
        
                                                                    $i_data = $i_rs->fetch_assoc();

                                                                 if ( $i_data["status"] == "0") {
                                                                    ?>
                                                                <span class="badge rounded-pill text-bg-warning p-3">Waiting to accept</span>
                                                                <?php
                                                                    
                                                                 }else if ( $i_data["status"] == "1") {
                                                                    ?>
                                                                <span class="badge rounded-pill text-bg-info p-3">Packing</span>
                                                                <?php
                                                                    
                                                                 }else if ( $i_data["status"] == "2") {
                                                                    ?>
                                                                <span class="badge rounded-pill text-bg-primary p-3">Dispatch</span>
                                                                <?php
                                                                    
                                                                 }else if ( $i_data["status"] == "3") {
                                                                    ?>
                                                                <span class="badge rounded-pill text-bg-success p-3">Shipping</span>
                                                                <?php
                                                                    
                                                                 } else {
                                                                    ?>
                                                                    <span class="badge rounded-pill text-bg-secondary p-3">Delivered</span>
                                                                    <?php
                                                                 }
                                                                 
                                                                ?>


                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class=" hr mt-5 bg-dark"></div>

                            <?php

                            }

                            ?>
                            <!-- card rows -->

                            <!-- <div class="col-12 mb-3">
                                <div class="row">
                                    <div class="offset-lg-10 col-12 col-lg-2 d-grid">
                                        <button class="btn btn-danger rounded mt-5 fs-5"onclick='removeFromhPurchasingHistory(<?php echo $list_id; ?>);'>
                                            <i class="bi bi-trash3-fill"></i> Delete All Records
                                        </button>
                                    </div>
                                </div>
                            </div> -->

                            <!-- model -->
    
                            <div class="modal" tabindex="-1" id="feedbackmodal<?php echo $invoice_data['product_id']; ?>"    >
                                <div class="modal-dialog">
                                    <div class="modal-content border border-4 border-light" style="background-color:#341807 ;">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold text-light">Add New Feedback</h5>
                                            <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold text-light">Type</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1" />
                                                                    <label class="form-check-label text-light fw-semibold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                                                    <label class="form-check-label text-light fw-semibold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-3">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type3" />
                                                                    <label class="form-check-label text-light fw-semibold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold text-light">User's Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" disabled id="mail" value="<?php echo $mail; ?>" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold text-light">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btnSub" onclick="saveFeedback(<?php echo $invoice_data['product_id']; ?>);">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->

                        </div>
                    </div>
                    <!-- Have Product -->
            <?php
                }
            }else{
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
</body>

</html>