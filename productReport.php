<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    $user = $_SESSION["au"]["email"];

    $a_rs = Database::search("SELECT DISTINCT`id`,`title`,`price`,`qty`,`datetime_added`,`cat_name`,`clr_name` FROM `product` 
    INNER JOIN glee.category ON product.category_cat_id = category.cat_id 
    INNER JOIN product_has_color ON product_has_color.product_id = product.id
    INNER JOIN glee.color ON color.clr_id = product_has_color.color_clr_id
    WHERE `user_email`='" . $user . "'");

    $a_num = $a_rs->num_rows;
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="style.css" />
        <title>Product Report</title>
    </head>

    <body>



        <div id="page">
            <div class="container mt-3">
                <h2 class="text-center text h1">Product Report</h2>
                <table class="table table-hover table-dark table-striped mt-5">

                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Catogary</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Added day</th>
                            <th>color</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        for ($i = 0; $i < $a_num; $i++) {
                            $a = $a_rs->fetch_assoc();
                        ?>
                            <tr>
                                <td><?php echo $a["id"] ?></td>
                                <td><?php echo $a["cat_name"] ?></td>
                                <td><?php echo $a["price"] ?></td>
                                <td><?php echo $a["qty"] ?></td>
                                <td><?php echo $a["datetime_added"] ?></td>
                                <td><?php echo $a["clr_name"] ?></td>
                            </tr>

                        <?php
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class=" col-1 offset-10 btnMain text-center fs-3 " onclick="printProductReport()">
        Print
        </div>

        <div onclick="window.location='adminPanel.php'" class="text-end">
            <i class="bi bi-arrow-left-square-fill h1 fixed-top "></i>
        </div>


        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </body>

    </html>

<?php
} else {
    echo ("You are not a valid admin");
}

?>

