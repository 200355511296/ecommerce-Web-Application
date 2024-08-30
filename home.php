<?php

include "connection.php";

?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home | Glee</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

    <div class="container-fluid">

        <div class="row">

            <?php include "header.php"; ?>

            <hr style="height: 5px;" class=" bg-black" />

            <div class="col-12 justify-content-center">

                <div class="row mb-3">


                    <div class="col-8 col-lg-6 offset-lg-2 offset-1">

                        <div class="input-group mt-3 mb-3">

                            <input type="text" class="form-control" aria-label="Text input with dropdown button" id="bst">

                            <select class="form-select" style="max-width: 250px;" id="bss">
                                <option value="0">All Categories</option>
                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"]; ?>
                                    </option>
                                <?php
                                }

                                ?>
                            </select>

                        </div>

                    </div>

                    <div class="col-2 col-lg-2  ">
                        <button class="btnSub  mt-3 mb-3 fw-semibold" onclick="basicSearch(0);">Search</button>
                    </div>

                    <?php

                    if (isset($_SESSION["u"])) {

                    ?>
                        <button class="btnMain mt-3 mb-3 col-1 btnMain">
                            <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold text-light " onclick="advancedSearch(0)">Advanced </a>
                        </button>
                    <?php
                    }

                    ?>

                </div>
            </div>

            <hr style="height: 5px;" class=" bg-black" />


            <div class="col-12" id="basicSearchResult">

                <div class="row">

                    <!-- Carousel -->

                    <div class="col-12 d-none d-lg-block mb-3">
                        <div class="row">

                            <div id="carouselExampleIndicators" class="offset-2 col-8 carousel slide" data-bs-ride="true">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 44"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="resource/slider_images/img1.png" class="d-block img-thumbnail " />
                                        <div class="carousel-caption d-none d-md-block aimgText">
                                            <h5 class="poster-title">Welcome to Glee</h5>
                                            <p class="poster-txt">The World's Best Online Store for jewelry.</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/img2.jpg" class="d-block img-thumbnail " />
                                    </div>
                                    <div class="carousel-item">
                                        <img src="resource/slider_images/img3.jpg" class="d-block img-thumbnail " />
                                    </div>

                                    <div class="carousel-item">
                                        <img src="resource/slider_images/img4.webp" class="d-block img-thumbnail " />
                                        <div class="carousel-caption d-none d-md-block poster-caption-1">
                                            <h5 class="zimgText">Give the gift of happiness</h5>
                                        </div>
                                    </div>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>

                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                            </div>

                        </div>
                    </div>

                    <!-- Carousel -->

                    <?php

                    $category_rs2 = Database::search("SELECT * FROM `category`");
                    $category_num2 = $category_rs2->num_rows;

                    for ($y = 0; $y < $category_num2; $y++) {
                        $category_data2 = $category_rs2->fetch_assoc();

                    ?>

                        <!-- Category Name -->

                        <div class="col-12 mt-3 mb-3">
                            <a href="#" class=" text-decoration-none text-dark ms-3 fs-1 letter1">
                                <?php echo $category_data2["cat_name"]; ?>
                            </a> &nbsp;&nbsp;
                        </div>

                        <!-- Category Name -->

                        <!-- products -->


                        <div class="col-12 mb-3">

                            <div class="row border border-secondary">

                                <div class="col-12">

                                    <div class="row justify-content-center gap-2">


                                        <?php




                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $category_data2["cat_id"] . "' 
                                                    AND `status_status_id`='1' ORDER BY `datetime_added` DESC ");

                                        $product_num = $product_rs->num_rows;

                                        for ($z = 0; $z < $product_num; $z++) {
                                            $product_data = $product_rs->fetch_assoc();
                                        ?>


                                            <div class="card col-6 col-lg-2 mt-2 mb-2  border border-3 rounded border-light" style="width: 18rem;">

                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                                ?>

                                                <img src="<?php echo $img_data["img_path"]; ?>" class=" mt-3 mb-3 shadow-lg" style="height: 180px;" />

                                                <div class="card-body ms-0 m-0 text-center fw-bold">
                                                    <div class=" mb-3">
                                                        <h5 class="card-title fw-bold fs-6 "><?php echo $product_data["title"]; ?></h5>
                                                    </div>
                                                    <div class=" mb-3">
                                                        <span class="badge rounded-pill text-bg-secondary mt-3 mb-3">New</span><br />
                                                    </div>
                                                    <div class=" mb-3">
                                                        <span class="card-text text mt-3 mb-3 fs-3">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                                                    </div>

                                                    <?php
                                                    if ($product_data["qty"] > 0) {
                                                    ?>

                                                        <span class="card-text text-dark fw-bold">In Stock</span><br />
                                                        <span class="card-text text-dark fw-bold"><?php echo $product_data["qty"]; ?> Items Available</span><br /><br />
                                                        <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class="col-12 btn btn-warning fw-semibold">Buy Now</a>

                                                        <?php

                                                        if (isset($_SESSION["u"])) {
                                                        ?>
                                                            <button class="col-12 btn btn-secondary mt-2">
                                                                <i class="bi bi-cart-plus-fill text-white fs-5" onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                                                            </button>
                                                        <?php

                                                        }
                                                        ?>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <span class="card-text text-dark fw-">Out Of Stock</span><br />
                                                        <span class="card-text text-dark fw-bold">00 Items Available</span><br /><br />
                                                        <a href='#' class="col-12 btn btn-seconddary disabled">
                                                            Buy Now
                                                        </a>
                                                        <button class="col-12 btn btn-dark mt-2 disabled">
                                                            <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                                                        </button>
                                                        <?php
                                                    }

                                                    if (isset($_SESSION["u"])) {

                                                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "' 
                                                            AND `product_id`='" . $product_data["id"] . "'");
                                                        $watchlist_num = $watchlist_rs->num_rows;

                                                        if ($watchlist_num == 1) {
                                                        ?>
                                                            <button class="col-12 btn btn-secondary mt-2" disabled onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                <i class="bi bi-heart-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                            </button>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <button class="col-12 btn btn-secondary mt-2" onclick='addToWatchlist(<?php echo $product_data["id"]; ?>);'>
                                                                <i class="bi bi-heart-fill text-light fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                                                            </button>
                                                    <?php
                                                        }
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- products -->
                    <?php
                    }

                    ?>

                    <!-- <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 ">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onload="window.location='home.php'" ; <?php
                                                                                                    } ?> aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <?php
                                for ($x = 1; $x <= $number_of_pages; $x++) {
                                    if ($x == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" onload="window.location='home.php'"><?php echo $x; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" onload="window.location='home.php'"><?php echo $x; ?></a>
                                        </li>
                                <?php
                                    }
                                }
                                ?>

                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onload="window.location='home.php'" ; <?php
                                                                                                    } ?> aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->



                </div>
            </div>




            <?php

            if ($product_data == 0) {
            ?>
                <div>
                    <?php include "footer.php" ?>
                </div>
            <?php

            } else {

                include "footer.php";
            }


            ?>




        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>

</body>

</html>