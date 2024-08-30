<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    $user = $_SESSION["au"]["email"];

    $a_rs = Database::search("SELECT invoice.user_email, DATE,total,status,title,cat_name FROM invoice 
    INNER JOIN product ON product.id = glee.invoice.product_id 
    INNER JOIN category ON  category.cat_id = product.category_cat_id
    WHERE `status`>= '0';");

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

                <div class=" col-4">

                    <table class="table table-hover table-dark table-striped mt-5 justify-content-center">
                        <thead>
                            <tr>
                                <th scope="col">Status ID</th>
                                <th scope="col">Meaning</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">0</th>
                                <td>Confirm Order</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Packing</td>
                            </tr><tr>
                                <th scope="row">2</th>
                                <td>Dispatch</td>
                            </tr><tr>
                                <th scope="row">3</th>
                                <td>Shipping</td>
                            </tr><tr>
                                <th scope="row">4</th>
                                <td>Delivered</td>
                            </tr>

                        </tbody>
                    </table>

                </div>



                <table class="table table-hover table-dark table-striped mt-5">

                    <thead>
                        <tr>
                            <th>Buyer email</th>
                            <th>Product Name</th>
                            <th>category</th>
                            <th>Total Price</th>
                            <th>status</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        for ($i = 0; $i < $a_num; $i++) {
                            $a = $a_rs->fetch_assoc();
                        ?>
                            <tr>
                                <td><?php echo $a["user_email"] ?></td>
                                <td><?php echo $a["title"] ?></td>
                                <td><?php echo $a["cat_name"] ?></td>
                                <td>Rs.<?php echo $a["total"] ?>.00</td>
                                <td><?php echo $a["status"] ?></td>
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