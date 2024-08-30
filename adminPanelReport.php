<?php

session_start();

require "connection.php";

if (isset($_SESSION["au"])) {

    $user = $_SESSION["au"]["email"];

    $a_rs = Database::search("SELECT fname,lname,email,mobile,gender.gender_name FROM user INNER JOIN gender ON user.gender_gender_id = gender.gender_id
    WHERE `power`='0'");
    $a_num = $a_rs->num_rows;

    // $email = "email"; 

    // $p_rs = Database::search("SELECT `price` FROM product INNER JOIN invoice ON 
    // product.user_email= invoice.user_email;");
    // $p_num = $p_rs->num_rows;
    // $p_data = $p_rs->fetch_assoc();    

    // $i_rs = Database::search ("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE `user_email`='". $email ."'");
    // $i_num = $a_rs->num_rows;    
    // $i_data = $i_rs->fetch_assoc();

    // $income = $i_data["qty_total"] * $p_data["price"];

  

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
                <h2 class="text-center text h1">AdminPanel Report</h2>
                <table class="table table-hover table-dark table-striped mt-5">

                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>email</th>
                            <th>Mobile</th>
                            <!-- <th>Total Income</th> -->

                        </tr>
                    </thead>

                    <tbody>

                        <?php

                        for ($i = 0; $i < $a_num; $i++) {
                            $a = $a_rs->fetch_assoc();
                        ?>
                            <tr>
                                <td><?php echo $a["fname"] ?></td>
                                <td><?php echo $a["lname"] ?></td>
                                <td><?php echo $a["email"] ?></td>
                                <td><?php echo $a["mobile"] ?></td>
                                <!-- <td>Rs. <?php echo $income; ?> .00</td> -->
                            
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