<?php

include "connection.php";

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$condition = $_POST["con"];
$color = $_POST["col"];
$price_from = $_POST["pf"];
$price_to = $_POST["pt"];
$sort = $_POST["s"];

$query = "SELECT * FROM `product`";
$status = 0;

if ($sort == 0) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%'";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "'";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "'";
    }

    $pid = 0;



    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "'";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "'";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "'";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "'";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "'";
        }
    }
} else if ($sort == 1) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC";
        $status = 1;
    }


    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "' ORDER BY `price` ASC";
    }



    $pid = 0;

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_condition_id`='" . $condition . "' ORDER BY `price` ASC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "' ORDER BY `price` ASC";
    }


    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` ASC";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` ASC";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` ASC";
        }
    }
} else if ($sort == 2) {

    if (!empty($search_txt)) {
        $query .= " WHERE `title` LIKE '%" . $search_txt . "%' ORDER BY `price` DESC";
        $status = 1;
    }




    if ($category != 0 && $status == 0) {
        $query .= " WHERE `category_cat_id`='" . $category . "' ORDER BY `price` DESC";
        $status = 1;
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id`='" . $category . "' ORDER BY `price` DESC";
    }



    $pid = 0;

    if ($condition != 0 && $status == 0) {
        $query .= " WHERE `condition_condition_id`='" . $condition . "' ORDER BY `price` DESC";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "' ORDER BY `price` DESC";
    }

    $cid = 0;
    if ($color != 0) {
        $clr_rs = Database::search("SELECT * FROM `product_has_color` WHERE `color_clr_id`='" . $color . "'");
        $clr_num = $clr_rs->num_rows;

        for ($x = 0; $x < $clr_num; $x++) {
            $clr_data = $clr_rs->fetch_assoc();
            $cid = $clr_data["product_id"];
        }

        if ($status == 0) {
            $query .= " WHERE `id`='" . $cid . "' ORDER BY `price` DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `id`='" . $cid . "' ORDER BY `price` DESC";
        }
    }

    if (!empty($price_from) && empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` >= '" . $price_from . "' ORDER BY `price` DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` >= '" . $price_from . "' ORDER BY `price` DESC";
        }
    }

    if (empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` <= '" . $price_to . "' ORDER BY `price` DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` <= '" . $price_to . "' ORDER BY `price` DESC";
        }
    }

    if (!empty($price_from) && !empty($price_to)) {
        if ($status == 0) {
            $query .= " WHERE `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` DESC";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $price_from . "' AND '" . $price_to . "' ORDER BY `price` DESC";
        }
    }
}



$pageno;

if ("0" != ($_POST["page"])) {
    $pageno = $_POST["page"];
} else {
    $pageno = 1;
}

$product_rs = Database::search($query);
$product_num = $product_rs->num_rows;

$results_per_page = 6;
$number_of_pages = ceil($product_num / $results_per_page);

$page_results = ($pageno - 1) * $results_per_page;
$selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

$selected_num = $selected_rs->num_rows;
for ($x = 0; $x < $selected_num; $x++) {
    $selected_data = $selected_rs->fetch_assoc();
?>
    <div class=" col-4 ms-auto ">

        <div class="row">

            <div class="card  mt-3 mb-3 bg-transparent border border-0 " style="width: 18rem;">

                <?php
                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                $img_data = $img_rs->fetch_assoc();
                ?>


                <div class="card  mt-2 mb-2  border border-3 rounded border-secondary" style="width: 18rem;">

                    <?php
                    $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $selected_data["id"] . "'");
                    $img_data = $img_rs->fetch_assoc();
                    ?>

                    <img src="<?php echo $img_data["img_path"]; ?>" class=" mt-3 mb-3 shadow-lg img-thumbnail" style="height: 180px;" />

                    <div class="card-body ms-0 m-0 text-center fw-bold">
                        <div class=" mb-3">
                            <h5 class="card-title fw-bold fs-6 "><?php echo $selected_data["title"]; ?></h5>
                        </div>
                        <div class=" mb-3">
                            <span class="badge rounded-pill text-bg-secondary mt-3 mb-3">New</span><br />
                        </div>
                        <div class=" mb-3">
                            <span class="card-text text mt-3 mb-3 fs-3">Rs. <?php echo $selected_data["price"]; ?> .00</span><br />
                        </div>

                        <?php
                        if ($selected_data["qty"] > 0) {
                        ?>

                            <span class="card-text text-dark fw-bold">In Stock</span><br />
                            <span class="card-text text-dark fw-bold"><?php echo $selected_data["qty"]; ?> Items Available</span><br /><br />
                            <a href='#' class="col-12 btn btn-warning fw-semibold">Buy Now</a>

                            <button class="col-12 btn btn-dark mt-2">
                                <i class="bi bi-cart-plus-fill text-white fs-5" onclick="addToCart(<?php echo $product_data['id']; ?>);"></i>
                            </button>


                        <?php

                        } else {
                        ?>
                            <span class="card-text text-dark fw-bold">Out Of Stock</span><br />
                            <span class="card-text text-dark fw-bold">00 Items Available</span><br /><br />
                            <a href='#' class="col-12 btn btn-warning disabled">Buy Now</a>
                            <button class="col-12 btn btn-dark mt-2 disabled">
                                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                            </button>
                        <?php
                        }
                        ?>

                        <button class="col-12 btn btn-outline-light mt-2 border border-secondar">
                            <i class="bi bi-heart-fill text-danger fs-5"></i>
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </div>

<?php
}
?>

<div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
    <nav aria-label="Page navigation example">
        <ul class="pagination pagination-lg justify-content-center">
            <li class="page-item">
                <a class="page-link" <?php if ($pageno <= 1) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno - 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <li class="page-item active">
                        <a class="page-link paginationColor" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="page-item">
                        <a class="page-link" onclick="advancedSearch(<?php echo ($x); ?>);"><?php echo $x; ?></a>
                    </li>
            <?php
                }
            }
            ?>

            <li class="page-item">
                <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                            echo ("#");
                                        } else {
                                        ?> onclick="advancedSearch(<?php echo ($pageno + 1); ?>);" ; <?php
                                                                                                    } ?> aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</div>