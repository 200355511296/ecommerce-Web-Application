<?php
session_start();
include "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Selling History | Admins | glee </title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />
</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

    <div class="container-fluid">

        <?php
        if (isset($_SESSION["au"])) {

            $user = $_SESSION["au"]["email"];
        ?>
            <div class="row">

                <div class="col-12  mb-2">
                    <div class="row">
                        <div class="offset-lg-4 col-12 col-lg-4">
                            <div class="row">
                                <div class="col-2">
                                    <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                </div>
                                <div class="col-10 text-center">
                                    <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Selling History</P>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 bg-t mransparent border border-3 border-secondary  t-3 mb-3">
                    <div class="row">
                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5">Search by Invoice ID : </label>
                            <input type="text" class="form-control fs-5" id="searchtxt" onkeyup="searchInvoice();" />
                        </div>
                        <div class="col-12 col-lg-2 mt-3 mb-3"></div>
                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5">From Date : </label>
                            <input type="date" class="form-control fs-5" id="from" />
                        </div>
                        <div class="col-12 col-lg-3 mt-3 mb-3">
                            <label class="form-label fs-5">To Date : </label>
                            <input type="date" class="form-control fs-5" id="to" />
                        </div>
                        <div class="col-12 col-lg-1 mt-3 mb-3 d-grid">
                            <button class="btnMain fs-5 fw-bold" onclick="findsellings();"><i class="bi bi-search text-light h1"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-1 bg-secondary bg-opacity-25 text-end">
                            <label class="form-label fs-5 fw-bold text-dark">Invoice ID</label>
                        </div>
                        <div class="col-3 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black">Product</label>
                        </div>
                        <div class="col-3 bg-secondary bg-opacity-25 text-end">
                            <label class="form-label fs-5 fw-bold text-dark">Buyer</label>
                        </div>
                        <div class="col-2 bg-body text-end">
                            <label class="form-label fs-5 fw-bold text-black">Amount</label>
                        </div>
                        <div class="col-1 bg-secondary bg-opacity-25 text-end">
                            <label class="form-label fs-5 fw-bold text-dark">Quantity</label>
                        </div>
                        <div class="col-2 "></div>

                    </div>
                </div>

                <?php
                $i_rs = Database::search("SELECT * FROM `invoice` WHERE `user_email`='" . $user . "'");

                $i_num = $i_rs->num_rows;
                if ($i_num == 0) {
                ?>
                    <!-- empty view -->
                    <div class="col-10  offset-1 min-vh-100">
                        <div class="row">
                            <div class="col-12 emptyView"></div>
                            <div class="col-12 text-center">
                                <label class="form-label fs-1 fw-bold mt-5">
                                    You have no items in Selling history.
                                </label>
                            </div>

                        </div>
                    </div>
                    <!-- empty view -->
                <?php
                } else {
                ?>
                    <div class="col-12 mt-2 " id="viewArea">

                        <?php

                        $query = "SELECT * FROM `invoice` ";
                        $pageno;

                        if (isset($_GET["page"])) {
                            $pageno = $_GET["page"];
                        } else {
                            $pageno = 1;
                        }

                        $invoice_rs = Database::search($query);
                        $invoice_num = $invoice_rs->num_rows;

                        $results_per_page = 20;
                        $number_of_pages = ceil($invoice_num / $results_per_page);

                        $page_results = ($pageno - 1) * $results_per_page; // 0 , 20 , 40
                        $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . "");

                        $selected_num = $selected_rs->num_rows;

                        for ($x = 0; $x < $selected_num; $x++) {
                            $selected_data = $selected_rs->fetch_assoc();
                        ?>

                            <div class="row mb-2">

                                <div class="col-1 bg-secondary bg-opacity-25 text-end">
                                    <label class="form-label fs-5 fw-bold text-dark mt-1 mb-1">
                                        <?php echo $selected_data["invoice_id"]; ?>
                                    </label>
                                </div>
                                <?php

                                $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $selected_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();

                                ?>
                                <div class="col-3 bg-body text-end">
                                    <label class="form-label fs-5 fw-bold text-black mt-1 mb-1">
                                        <?php echo $product_data["title"]; ?>
                                    </label>
                                </div>
                                <?php

                                $user_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $selected_data["user_email"] . "'");
                                $user_data = $user_rs->fetch_assoc();

                                ?>
                                <div class="col-3 bg-secondary bg-opacity-25 text-end">
                                    <label class="form-label fs-5 fw-bold text-dark mt-1 mb-1">
                                        <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?>
                                    </label>
                                </div>
                                <div class="col-2 bg-body text-end">
                                    <label class="form-label fs-5 fw-bold text-black mt-1 mb-1">
                                        Rs. <?php echo $selected_data["total"]; ?> .00
                                    </label>
                                </div>
                                <div class="col-1 bg-secondary bg-opacity-25 text-end">
                                    <label class="form-label fs-5 fw-bold text-dark mt-1 mb-1"><?php echo $selected_data["qty"]; ?></label>
                                </div>
                                <div class="col-2  d-grid">
                                    <?php
                                    if ($selected_data["status"] == 0) {
                                    ?>
                                        <button class="btnSub fw-bold mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Confirm Order</button>
                                    <?php
                                    } else if ($selected_data["status"] == 1) {
                                    ?>
                                        <button class="btn btn-warning fw-bold mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Packing</button>
                                    <?php
                                    } else if ($selected_data["status"] == 2) {
                                    ?>
                                        <button class="btn btn-info fw-bold mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Dispatch</button>
                                    <?php
                                    } else if ($selected_data["status"] == 3) {
                                    ?>
                                        <button class="btn btn-primary fw-bold mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Shipping</button>
                                    <?php
                                    } else if ($selected_data["status"] == 4) {
                                    ?>
                                        <button class="btn btn-danger fw-bold mt-1 mb-1" id="btn<?php echo $selected_data["invoice_id"]; ?>" onclick="changeInvoiceStatus('<?php echo $selected_data['invoice_id']; ?>');">Delivered</button>
                                    <?php
                                    }
                                    ?>

                                </div>

                            </div>

                        <?php
                        }
                        ?>

                        <!--  -->
                        <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3 mt-3">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-lg justify-content-center">
                                    <li class="page-item">
                                        <a class="page-link" href="
<?php if ($pageno <= 1) {
                        echo ("#");
                    } else {
                        echo "?page=" . ($pageno - 1);
                    } ?>
" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php
                                    for ($x = 1; $x <= $number_of_pages; $x++) {
                                        if ($x == $pageno) {
                                    ?>
                                            <li class="page-item active">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="page-item">
                                                <a class="page-link" href="<?php echo "?page=" . ($x); ?>"><?php echo $x; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>

                                    <li class="page-item">
                                        <a class="page-link" href="
<?php if ($pageno >= $number_of_pages) {
                        echo ("#");
                    } else {
                        echo "?page=" . ($pageno + 1);
                    } ?>
" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    <?php
                }

                    ?>


                    <!--  -->
                    </div>

                    <div onclick="window.location='adminPanel.php'" class="text-end">
                        <i class="bi bi-arrow-left-square-fill h1 fixed-top "></i>
                    </div>

            </div>
        <?php
        }
        ?>

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>