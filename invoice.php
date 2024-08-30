<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice | Glee</title>

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
                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];

            ?>


                <div class="col-12 btn-toolbar justify-content-end mt-4 mb-4">
                    <button class="btnSub me-2" onclick="printInvoice();"><i class="bi bi-printer-fill"></i> Print</button>
                </div>


                <div class="col-12" id="page">
                    <div class="row">

                        <div class="col-6">
                            <div class="ms-5"></div>
                        </div>

                        <div class="col-6">
                            <div class="row">

                                <div class="col-12 text-end">
                                    <h5 class="text-uppercase mb-4 footerletter" style="color:#572305 !important;">Glee</h5>
                                </div>

                                <div class="col-12 fw-bold text-end me-2">
                                <p><i class="bi bi-house-fill"></i> 14/A, Pilimathalawa, kandy , Sri Lanka</p>
                                    <p><i class="bi bi-at"></i> Glee@gmail.com</p>
                                    <p><i class="bi bi-telephone-fill"></i> +94 714 897 002</p>
                                    <p><i class="bi bi-printer-fill"></i> +94 714 897 002</p>
                                </div>


                                    

                            </div>
                        </div>

                        <hr style="height: 5px;" class=" bg-black" />

                        <div class="col-12 mb-4">
                            <div class="row">

                                <?php

                                $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='" . $umail . "'");
                                $address_data = $address_rs->fetch_assoc();

                                ?>

                                <div class="col-6">
                                    <h5 class="fw-bold">INVOICE TO :</h5>
                                    <h2><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></h2>
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br />
                                    <span><?php echo $umail; ?></span>
                                </div>

                                <?php

                                $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "'");
                                $invoice_data = $invoice_rs->fetch_assoc();

                                ?>

                                <div class="col-6 text-end mt-4">
                                    <h1 class="text fw-semibold">INVOICE <?php echo $invoice_data["invoice_id"]; ?></h1>
                                    <span class="fw-bold">Data & Time of Invoice : </span>&nbsp;
                                    <span class="fw-bold"><?php echo $invoice_data["date"]; ?></span>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr class="border border-1 border-dark fw-semibold">
                                        <th>#</th>
                                        <th>Order ID & Product</th>
                                        <th class="text-end">Unit Price</th>
                                        <th class="text-end">Quantity</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 72px;" class=" border border-dark">
                                        <td class=" text-light bg-secondary text-center fw-bold  fs-2"><?php echo $invoice_data["invoice_id"]; ?></td>
                                        <td>
                                            <span class="fw-bold text-dark text-decoration-underline p-2"><?php echo $oid; ?></span><br />
                                            <?php

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invoice_data["product_id"] . "'");
                                            $product_data = $product_rs->fetch_assoc();

                                            ?>
                                            <span class="fw-semibold text-dark fs-3 p-2"><?php echo $product_data["title"]; ?></span>
                                        </td>
                                        <td class="fw-semibold fs-4 text-end pt-3  text">Rs. <?php echo $product_data["price"]; ?> .00</td>

                                        <td class="fw-semibold fs-5 text-end pt-3"><?php echo $invoice_data["qty"]; ?></td>
                                        
                                        <td class="fw-semibold fs-4 text-end pt-3  text">Rs. <?php echo $invoice_data["total"]; ?> .00</td>

                                    </tr>
                                </tbody>
                                <tfoot>

                                    <?php

                                    $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                                    $city_data = $city_rs->fetch_assoc();

                                    $delivery = 0;

                                    if ($city_data["district_district_id"] == 4) {
                                        $delivery = $product_data["delivery_fee_colombo"];
                                    } else {
                                        $delivery = $product_data["delivery_fee_other"];
                                    }

                                    $t = $invoice_data["total"];
                                    $g = $t - $delivery;

                                    ?>

                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-center fw-bold">SUBTOTAL</td>
                                        <td class="text-end ">Rs. <?php echo $g; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-center fw-bold border-dark">Delivery Fee</td>
                                        <td class="text-end  border-dark">Rs. <?php echo $delivery; ?> .00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="border-0"></td>
                                        <td class="fs-5 text-center fw-bold border-secondary border-end text-primary " id="total">GRAND TOTAL</td>
                                        <td class="fs-5 text-end  fw-bold border-secondary text-primary" id="total">Rs. <?php echo $t; ?> .00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="col-12 text-center">
                            <span class=" footerletter text fs-1">Thank You !</span>
                        </div>

                        <div class=" col-lg-4 col-10 border-end mt-3 mb-3 border-0 border-start border-5 border-dark rounded offset-lg-4 offset-1 bg-light" >
                            <div class="row">
                                <div class="col-12 mt-3 mb-3">
                                    <label class="form-label fs-5 fw-bold">NOTICE : </label>
                                    <br />
                                    <label class="form-label fs-6">Purchased items can return befor 7 days of Delivery.</label>
                                </div>
                            </div>
                        </div>

                       

                        <div class="col-12 text-center mb-3">
                            <label class="form-label fs-5 text-black-50 fw-bold">
                                Invoice was created on a computer and is valid without the Signature and Seal.
                            </label>
                        </div>

                    </div>
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