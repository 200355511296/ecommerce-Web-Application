<?php

session_start();
include "connection.php";

if (isset($_SESSION["au"])) {


?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Admin Panel | Glee </title>

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="style.css" />

        <link rel="icon" href="resource/logo.svg" />
    </head>

    <body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);" onload="loadChart();">


        <div class="container-fluid">

            <div class="row">

                <div class="col-12 col-lg-2 position-fixed">
                    <div class="row">
                        <div class="col-12 align-items-start bg-secondary vh-100">
                            <div class="row g-1 text-center">

                                <div class="col-12 mt-5">
                                    <h6 class=" text-dark">Welcome,Admin</h6>
                                    <h4 class="text-dark"><?php echo $_SESSION["au"]["fname"] . " " . $_SESSION["au"]["lname"]; ?></h4>
                                    <hr class="border border-1 border-white" />
                                </div>

                                <div class="nav flex-column nav-pills me-3 mt-3" role="tablist" aria-orientation="vertical">

                                    <nav class="nav flex-column">

                                        <button class=" btnSub mt-3 mb3 " onclick="window.location.reload">Dashboard</button>
                                        <button class=" btnSub mt-3 mb3 " onclick="window.location='manageUsers.php'">Manage Users</button>
                                        <button class=" btnSub mt-3 mb3 " onclick="window.location='manageProducts.php'">Manage Products</button>
                                        <button class=" btnSub mt-3 mb3 " onclick="window.location='sellingHistory.php'">Selling History</button>
                                        <button class=" btnSub mt-3 mb3 " onclick="window.location='myProducts.php'">My Products</button>
                                        <button class=" btnSub mt-3 mb3 " onclick="window.location='home.php'">Shoping</button>
                                        <div class="dropdown">
                                            <button class="btnMain mt-3 mb-3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Reports</button>

                                            <ul class="dropdown-menu bg-secondary border-1 border-light">
                                                <li><a class="dropdown-item text-dark fw-bold" href="productReport.php">product</a></li>
                                                <li><a class="dropdown-item text-dark fw-bold" href="userReport.php">user</a></li>
                                                <li><a class="dropdown-item text-dark fw-bold" href="adminPanelReport.php">Admin Panel</a></li>
                                                <li><a class="dropdown-item text-dark fw-bold" href="sellingReport.php">Selling History</a></li>
                                                <!-- <li><a class="dropdown-item text-dark fw-bold" href="feedbackSumReport.php">Feedback Summery</a></li> -->

                                            </ul>
                                        </div>


                                    </nav>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-10 offset-2 ">
                    <div class="row">

                        <div class="text-white fw-bold mb-1 mt-3">

                            <h1 class="fw-bold text-dark"><i class="bi bi-list accordiong h1 text-dark"></i>Dashboard</h1>
                        </div>
                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12 bg-dark mb-3">
                            <div class="row">
                                <div class="col-12 col-lg-2 text-center my-3">
                                    <label class="form-label fs-4 fw-bold text-white">Total Active Time</label>
                                </div>
                                <div class="col-12 col-lg-10 text-center my-3">

                                    <?php

                                    $start_date = new DateTime("2024-01-01 19:00:00");

                                    $tdate = new DateTime();
                                    $tz = new DateTimeZone("Asia/Colombo");
                                    $tdate->setTimezone($tz);
                                    $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                                    $difference = $end_date->diff($start_date);

                                    ?>

                                    <label class="form-label fs-4 fw-bold text-warning">
                                        <?php
                                        echo $difference->format('%Y') . " Years " . $difference->format('%m') . " Months " .
                                            $difference->format('%d') . " Days " . $difference->format('%H') . " Hours " .
                                            $difference->format('%i') . " Minutes " . $difference->format('%s') . " Seconds";
                                        ?>

                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>

                        <div class="col-12">
                            <div class="row g-1">

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">

                                            <br />

                                            <span class="fs-4 fw-bold">Daily Earnings</span>

                                            <?php

                                            $today = date("Y-m-d");
                                            $thismonth = date("m");
                                            $thisyear = date("Y");

                                            $a = "0";
                                            $b = "0";
                                            $c = "0";
                                            $e = "0";
                                            $f = "0";

                                            $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                            $invoice_num = $invoice_rs->num_rows;

                                            for ($x = 0; $x < $invoice_num; $x++) {
                                                $invoice_data = $invoice_rs->fetch_assoc();

                                                $f = $f + $invoice_data["qty"]; //total qty

                                                $d = $invoice_data["date"];
                                                $splitDate = explode(" ", $d); //separate the date from time
                                                $pdate = $splitDate["0"]; //sold date

                                                if ($pdate == $today) {
                                                    $a = $a + $invoice_data["total"];
                                                    $c = $c + $invoice_data["qty"];
                                                }

                                                $splitMonth = explode("-", $pdate); //separate date as year,month & day
                                                $pyear = $splitMonth["0"]; //year
                                                $pmonth = $splitMonth["1"]; //month

                                                if ($pyear == $thisyear) {
                                                    if ($pmonth == $thismonth) {
                                                        $b = $b + $invoice_data["total"];
                                                        $e = $e + $invoice_data["qty"];
                                                    }
                                                }
                                            }

                                            ?>

                                            <br />
                                            <span class="fs-5">Rs. <?php echo $a; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-light text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Earnings</span>
                                            <br />

                                            <span class="fs-5">Rs. <?php echo $b; ?> .00</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Today Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $c; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Monthly Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $e; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Sellings</span>
                                            <br />
                                            <span class="fs-5"><?php echo $f; ?> Items</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6 col-lg-4 px-1 shadow">
                                    <div class="row g-1">
                                        <div class="col-12 bg-secondary text-white text-center rounded" style="height: 100px;">
                                            <br />
                                            <span class="fs-4 fw-bold">Total Engagements</span>
                                            <br />
                                            <?php
                                            $user_rs = Database::search("SELECT * FROM `user`");
                                            $user_num = $user_rs->num_rows;
                                            ?>
                                            <span class="fs-5"><?php echo $user_num; ?> Members</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <hr />
                        </div>



                        <!-- chart -->
                        <div class=" col-6 offset-3 mt-5 justify-content-center bg-secondary bg-opacity-25 rounded-4">
                            <h1 class=" text-center">Most Sold Product</h1>
                            <canvas id="myChart"></canvas>
                        </div>
                        <!-- chart -->

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">
                            <div class="row g-1">
                                <div class="col-12 text-center">
                                    <label class="form-label fs-4 fw-bold text-decoration-underline">Mostly Sold Item</label>
                                </div>

                                <?php

                                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence` FROM `invoice` 
                                WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY `value_occurence` DESC LIMIT 1");

                                $freq_num = $freq_rs->num_rows;

                                if ($freq_num > 0) {

                                    $freq_data = $freq_rs->fetch_assoc();

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                    $product_data = $product_rs->fetch_assoc();

                                    $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                    $image_data = $image_rs->fetch_assoc();

                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE 
                                    `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                    $qty_data = $qty_rs->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center shadow">
                                        <img src="<?php echo $image_data["img_path"]; ?>" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $product_data["title"]; ?></span><br />
                                        <span class="fs-6"><?php echo $qty_data["qty_total"]; ?> items</span><br />
                                        <span class="fs-6">Rs. <?php echo $qty_data["qty_total"] * $product_data["price"]; ?> .00</span>
                                    </div>
                                <?php

                                } else {
                                ?>
                                    <!-- empty product -->
                                    <div class="col-12 text-center shadow">
                                        <img src="resource/empty.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">-----</span><br />
                                        <span class="fs-6">--- items</span><br />
                                        <span class="fs-6">Rs. ----- .00</span>
                                    </div>
                                    <!-- empty product -->
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>

                        <div class="offset-1 col-10 col-lg-4 my-3 rounded bg-body">

                            <div class="row g-1">

                                <?php

                                if ($freq_num > 0) {

                                    $profile_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $product_data["user_email"] . "'");
                                    $profile_data = $profile_rs->fetch_assoc();

                                    $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                    $user_data1 = $user_rs1->fetch_assoc();

                                ?>
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <!-- <img src="resource/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" /> -->
                                            <?php
                                            $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $user_data1["email"]  . "'");
                                            $img_num = $img_rs->num_rows;

                                            if ($img_num == 1) {
                                                $img_data = $img_rs->fetch_assoc();
                                            ?>
                                                <img src="<?php echo $img_data["path"]; ?>" class="img-fluid rounded-top" style="height: 250px;"" />
                                    <?php
                                            } else {
                                    ?>
                                            <img src=" resource/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" /> <?php
                                                                                        }
                                                                                            ?>
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold"><?php echo $user_data1["fname"] . " " . $user_data1["lname"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["email"]; ?></span><br />
                                        <span class="fs-6"><?php echo $user_data1["mobile"]; ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <!-- empty user -->
                                    <div class="col-12 text-center">
                                        <label class="form-label fs-4 fw-bold text-decoration-underline">Most Famouse Seller</label>
                                    </div>
                                    <div class="col-12 text-center shadow">
                                        <img src="resource/new_user.svg" class="img-fluid rounded-top" style="height: 250px;" />
                                    </div>
                                    <div class="col-12 text-center my-3">
                                        <span class="fs-5 fw-bold">----- -----</span><br />
                                        <span class="fs-6">-----</span><br />
                                        <span class="fs-6">----------</span>
                                    </div>
                                    <!-- empty user -->
                                <?php
                                }

                                ?>

                                <div class="col-12">
                                    <div class="first-place"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>



            </div>

        </div>



        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    </body>

    </html>

<?php

} else {
    echo ("You are not a valid user.");
}

?>