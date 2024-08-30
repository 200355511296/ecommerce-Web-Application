<?php

session_start();

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Products | Admins | Glee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

    <div class="container-fluid">
        <div class="row">

            <?php
            if (isset($_SESSION["au"])) {

                $user = $_SESSION["au"]["email"];
            ?>

                <div class="col-12  mb-2">
                    <div class="row">
                        <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                </div>
                                <div class="col-10 text-center">
                                    <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Manage All Products</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-12 mt-3">
                    <div class="row">
                        <div class="offset-0 offset-lg-3 col-12 col-lg-6 mb-3">
                            <div class="row">
                                <div class="col-9">
                                    <input type="text" class="form-control"  />
                                </div>
                                <div class="col-3 d-grid">
                                    <button class="btn btn-warning" id="input" onclick="search(0);">Search Product</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class=" col-2 btnMain text-center p-2 fs-2 ms-3">
                    <a href="#bottom" class=" text-decoration-none text-light">Add Category</a>
                    
                </div>

                <div class="col-12 mt-3 mb-3 offset-1">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-secondary bg-opacity-25 py-2 text-end">
                            <span class="fs-4 fw-bold text-dark">#</span>
                        </div>
                        <!-- <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-4 fw-bold">Product Image</span>
                        </div> -->
                        <div class="col-4 col-lg-2 bg-secondary bg-opacity-25 py-2">
                            <span class="fs-4 fw-bold text-dark">Title</span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                            <span class="fs-4 fw-bold">Price</span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-secondary bg-opacity-25 py-2">
                            <span class="fs-4 fw-bold text-dark">Quantity</span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <span class="fs-4 fw-bold">Registered Date</span>
                        </div>
                        <div class="col-2 col-lg text-dark"></div>
                    </div>
                </div>

                <?php
                $a_rs = Database::search("SELECT * FROM `product` WHERE `user_email`='" . $user . "'");

                $a_num = $a_rs->num_rows;

                if ($a_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-10  offset-1 min-vh-100">
                        <div class="row">
                            <div class="col-12 emptyView"></div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-1 fw-bold mt-5">
                                    You have no items in Manage Products.
                                </label>
                            </div>

                        </div>
                    </div>
                    <!-- empty view -->
                    <?php
                } else {


                    $query = "SELECT * FROM `product`";
                    

                    $product_rs = Database::search($query);
                    $product_num = $product_rs->num_rows;

                
                    $selected_rs = Database::search($query);
                    $selected_num = $selected_rs->num_rows;

                    for ($x = 0; $x < $selected_num; $x++) {
                        $selected_data = $selected_rs->fetch_assoc();

                    ?>

                        <div class="col-12 mt-3 mb-3 offset-1" id="searchResult" >
                            <div class="row">
                                <div class="col-2 col-lg-1 bg-secondary bg-opacity-25 py-2 text-end">
                                    <span class="fs-4 fw-bold text-dark"><?php echo $x + 1; ?></span>
                                </div>

                                <!-- <div class="col-2 d-none d-lg-block bg-light py-2" onmouseenter="viewProductModal('<?php echo $selected_data['id']; ?>');">

                                    <?php
                                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");

                                    $product_img_num = $product_img_rs->num_rows;

                                    if ($product_img_num == 1) {

                                        $product_img_data = $product_img_rs->fetch_assoc();
                                    ?>
                                        <img src="<?php echo $product_img_data["img_path"]; ?>" style="height: 40px;margin-left: 80px;" />
                                    <?php
                                    } else {
                                    ?>

                                        <img src="resource/empty.svg" style="height: 40px;margin-left: 80px;" />
                                    <?php
                                    }
                                    ?>
                                </div> -->

                                <div class="col-4 col-lg-2 bg-secondary bg-opacity-25 py-2">
                                    <span class="fs-5 fw-bold text-dark"><?php echo $selected_data["title"]; ?></span>
                                </div>
                                <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                                    <span class="fs-4 fw-bold"><?php echo $selected_data["price"]; ?></span>
                                </div>
                                <div class="col-2 d-none d-lg-block bg-secondary bg-opacity-25 py-2">
                                    <span class="fs-4 fw-bold text-dark"><?php echo $selected_data["qty"]; ?></span>
                                </div>
                                <div class="col-2 d-none d-lg-block bg-light py-2">
                                    <span class="fs-5 fw-bold"><?php echo $selected_data["datetime_added"]; ?></span>
                                </div>
                                <div class="col-2 col-lg-1 bg-white py-2 d-grid">


                                    <div class="col-2 col-lg-1 bg-white py-2 d-grid">
                                        <?php
                                        if ($selected_data["status_status_id"] == 1) {
                                        ?>
                                            <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" class="btn btn-danger">Block</button>
                                        <?php
                                        } else {
                                        ?>
                                            <button id="pb<?php echo $selected_data['id']; ?>" onclick="blockProduct('<?php echo $selected_data['id']; ?>');" class="btn btn-success">Unblock</button>
                                        <?php
                                        }
                                        ?>

                                    </div>


                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>


                    <!-- modal 01 -->
                    <div class="modal" tabindex="-1" id="viewProductModal<?php echo $selected_data['id']; ?>">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold text-success"><?php echo $selected_data['title']; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="offset-4 col-4" onclick="viewProductModal('<?php echo $selected_data['id']; ?>');">

                                        <?php
                                        $image_rs1 = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                                        $image_num1 = $image_rs1->num_rows;
                                        if ($image_num1 == 0) {
                                        ?>
                                            <img src="resource/empty.svg" class="img-fluid" style="height: 150px;" />
                                        <?php
                                        } else {
                                            $image_data1 = $image_rs1->fetch_assoc();
                                        ?>
                                            <img src="<?php echo $image_data1["img_path"]; ?>" class="img-fluid" style="height: 150px;" />
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-12">
                                        <span class="fs-5 fw-bold">Price :</span>&nbsp;
                                        <span class="fs-5">Rs. <?php echo $selected_data['price']; ?> .00</span><br />
                                        <span class="fs-5 fw-bold">Quantity :</span>&nbsp;
                                        <span class="fs-5"><?php echo $selected_data['qty']; ?> Products left</span><br />
                                        <span class="fs-5 fw-bold">Seller :</span>&nbsp;
                                        <?php
                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data['user_email'] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        ?>
                                        <span class="fs-5"><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br />
                                        <span class="fs-5 fw-bold">Description :</span>&nbsp;
                                        <span class="fs-5"><?php echo $selected_data['description']; ?></span><br />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal 01 -->

                   
                    <hr />

                    <div class="col-12 text-center">
                        <h3 class="text-black fw-bold bottom" id="bottom">Manage Categories</h3>
                    </div>

                    <div class="col-12 mb-3">
                        <div class="row gap-1 justify-content-center">

                            <?php
                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <div class="col-12 col-lg-3 border border-dark rounded" style="height: 50px;">
                                    <div class="col-8 mt-2 mb-2">
                                        <label class="form-label fw-bold fs-5"><?php echo $category_data["cat_name"]; ?></label>
                                    </div>

                                </div>
                            <?php
                            }
                            ?>

                            <div class="col-12 col-lg-3 border border-success rounded" style="height: 50px;">
                                <div class="row">
                                    <div class="col-8 mt-2 mb-2">
                                        <input type="text" class="  bg-transparent border border-0 p- text-dark form-control " placeholder="New category" id="cat">
                                    </div>
                                    <div class="col-4 border-start border-secondary text-center mt-2 mb-2">
                                        <label class="form-label fs-4"><i class="bi bi-plus-square-fill text-success" onclick="addNewCategory();"></i></label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div onclick="window.location='adminPanel.php'" class="text-end">
                        <i class="bi bi-arrow-left-square-fill h1 fixed-top "></i>
                    </div>


                <?php
                }
                ?>
        </div>
    <?php
            }
    ?>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>

</html>