<?php
session_start();
include "connection.php";


if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    if (isset($_SESSION["p"])) {


        $product = $_SESSION["p"];

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Update Product | glee</title>
            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.svg" />

        </head>

        <body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">


            <div class="container-fluid ">

                <div class="row gy-3">



                    <div class="col-12">

                        <div class="row">


                            <!-- header -->
                            <div class="col-12 footer p-3">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="row">
                                            <div class="col-12 col-lg-4 mt-1 mb-1 text-center">
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");
                                                $img_num = $img_rs->num_rows;

                                                if ($img_num == 1) {
                                                    $img_data = $img_rs->fetch_assoc();
                                                ?>
                                                    <img src="<?php echo $img_data["path"]; ?>" width="90px" height="90px" class="rounded-circle" />
                                                <?php
                                                } else {
                                                ?>
                                                    <img src="resources/new_user.svg" width="90px" height="90px" class="rounded-circle" />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="col-12 col-lg-8">
                                                <div class="row text-center text-lg-start">
                                                    <div class="col-12 mt-0 mt-lg-4">
                                                        <span class="text-white fw-light h5">
                                                            <?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?>
                                                        </span>
                                                    </div>
                                                    <div class="col-12">
                                                        <span class="text-white "><?php echo $email; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-8">
                                        <div class="row">
                                            <div class="col-12 col-lg-8 mt-2 my-lg-4">
                                                <h1 class="offset-4 offset-lg-2 text-white fw-bold">Update Product</h1>
                                            </div>



                                            <div class=" col-3 col-lg-2 align-items-end  mx-2 mb-2 my-lg-4 mx-lg-0 d-grid">

                                                <a href="adminPanel.php" class="form-floating text-white ">
                                                    <i class="bi bi-shop-window" style="font-size: 20px; margin-left:50px ;"></i>
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- header -->

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;" di>Product Category</label>
                                            </div>

                                            <div class="col-8 offset-2">
                                                <select class="form-select text-center" disabled>
                                                    <?php
                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "'");
                                                    $category_data = $category_rs->fetch_assoc();
                                                    ?>
                                                    <option><?php echo $category_data["cat_name"]; ?></option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>


                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">
                                                    Product Title
                                                </label>
                                            </div>
                                            <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                <input type="text" class="form-control" value="<?php echo $product["title"]; ?>" id="t" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12 col-lg-4 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Condition</label>
                                                    </div>
                                                    <?php

                                                    if ($product["condition_condition_id"] == 1) {
                                                    ?>
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="b">hand made</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="u">import</label>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="b">hand made</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="u">import</label>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }

                                                    ?>

                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4 border-end border-dark">
                                                <div class="row">

                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Colour</label>
                                                    </div>

                                                    <div class="col-12">
                                                        <select class="form-select" disabled >
                                                            <?php
                                                            $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product_has_color` ON 
                                                            color.clr_id=product_has_color.color_clr_id WHERE `product_id`='" . $product["id"] . "'");
                                                            $color_data = $color_rs->fetch_assoc();
                                                            ?>
                                                            <option><?php echo $color_data["clr_name"]; ?></option>
                                                        </select>
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="col-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control" min="0" value="<?php echo $product["qty"]; ?>" id="q" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Cost Per Item</label>
                                                    </div>
                                                    <div class="offset-0 offset-lg-2 col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-6">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold" style="font-size: 20px;">Approved Payment Methods</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="offset-0 offset-lg-2 col-2 pm pm1"></div>
                                                            <div class="col-2 pm pm2"></div>
                                                            <div class="col-2 pm pm3"></div>
                                                            <div class="col-2 pm pm4"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Delivery Cost</label>
                                            </div>
                                            <div class="col-12 col-lg-6 border-end border-dark">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost Within Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <div class="row">
                                                    <div class="col-12 offset-lg-1 col-lg-3">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 col-lg-8">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <label class="form-label fw-bold" style="font-size: 20px;">Product Description</label>
                                            </div>
                                            <div class="col-12">
                                                <textarea cols="30" rows="15" class="form-control" id="d"><?php echo $product["description"]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class="col-12 justify-content-center">

                                        <div class="col-12">
                                            <label class="form-label fw-bold" style="font-size: 20px;">Add Product Images</label>
                                        </div>

                                        <div class="col-10 d-grid">

                                            <?php

                                            $img = array();

                                            $img[0] = "resource/addproductimg.svg";
                                            $img[1] = "resource/addproductimg.svg";
                                            $img[2] = "resource/addproductimg.svg";

                                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product["id"] . "'");
                                            $product_img_num = $product_img_rs->num_rows;

                                            for ($x = 0; $x < $product_img_num; $x++) {
                                                $product_img_data = $product_img_rs->fetch_assoc();

                                                $img[$x] = $product_img_data["img_path"];
                                            }

                                            ?>

                                            <div class="row">
                                                <div class="col-3 border border-dark rounded ms-auto ">
                                                    <img id="i0" src="<?php echo $img[0]; ?>" class="img-fluid p-3 " style="width: 250px;" />
                                                </div>
                                                <div class="col-3 border border-dark rounded ms-auto">
                                                    <img id="i1" src="<?php echo $img[1]; ?>" class="img-fluid p-3" style="width: 250px;" />
                                                </div>
                                                <div class="col-3 border border-dark rounded ms-auto">
                                                    <img id="i2" src="<?php echo $img[2]; ?>" class="img-fluid p-3" style="width: 250px;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 offset-5 mt-3 btnMain text-center">
                                            <input type="file" class="d-none" id="imageuploader" multiple />
                                            <label for="imageuploader" class="col-12" onclick="changeProductImage()">Upload Images</label>
                                        </div>

                                    </div>

                                    <div class="col-12">
                                        <hr class="border-dark" />
                                    </div>

                                    <div class=" row  ">

                                        <div class="col-4 col-lg-4 offset-lg-4 d-grid mt-3 mb-3 offset-3 ">
                                            <button class="btnSub fw-bold text-dark" onclick="updateProduct();">Update Product</button>
                                        </div>

                                        <div class=" col-2 col-lg-4 d-grid mt-3 mb-3 ">
                                            <a href="myProducts.php"><button class="btn btn-light fw-bold border border-dark">Back</button></a>
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                <?php
            } else {
                ?>
                    <script>
                        alert("Please select a product to update.");
                        window.location = "myProducts.php";
                    </script>
                <?php
            }
        } else {

                ?>

                <script>
                    alert("You have to signin to the system for access this function.");
                    window.location = "home.php";
                </script>
            <?php

        }

        include "footer.php";


            ?>
            </div>



            </div>

            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>

        </body>

        </html>