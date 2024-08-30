<?php

require "connection.php";

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Users | Admins | Glee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/logo.svg" />

</head>

<body style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">


    <div class="container-fluid">
        <div class="row">

            <div class="col-12  mb-2">
                <div class="row">
                    <div class="offset-lg-4 col-12 col-lg-4">
                        <div class="row">
                            <div class="col-2">
                                <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                            </div>
                            <div class="col-10 text-center">
                                <P class=" fs-1 mt-3 pt-2 letter1 text-dark">Manage All Users</P>
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
                                <input type="text" class="form-control" />
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-warning">Search User</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-12 mt-3 mb-3">
                <div class="row">
                    <div class="col-2 col-lg-1 bg-secondary bg-opacity-25 py-2 text-end">
                        <span class="fs-4 fw-bold text-dark">#</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Profile Image</span>
                    </div>
                    <div class="col-4 col-lg-2 bg-secondary bg-opacity-25 py-2">
                        <span class="fs-4 fw-bold text-dark">User Name</span>
                    </div>
                    <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                        <span class="fs- fw-bold">Email</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-secondary bg-opacity-25 py-2">
                        <span class="fs-4 fw-bold text-dark">Mobile</span>
                    </div>
                    <div class="col-2 d-none d-lg-block bg-light py-2">
                        <span class="fs-4 fw-bold">Registered Date</span>
                    </div>
                    <div class="col-2 col-lg-1 "></div>
                </div>
            </div>

            <?php

            $query = "SELECT * FROM user  WHERE `power`='1'; ";

            $pageno;

            if (isset($_GET["page"])) {
                $pageno = $_GET["page"];
            } else {
                $pageno = 1;
            }

            $user_rs = Database::search($query);

            $user_num = $user_rs->num_rows;

            $results_per_page = 20;
            $number_of_pages = ceil($user_num / $results_per_page);

           

            $selected_rs = Database::search($query);

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

            ?>
                <div class="col-12 mt-3 mb-3">
                    <div class="row">
                        <div class="col-2 col-lg-1 bg-secondary bg-opacity-25 py-2 text-end">
                            <span class="fs-4 text-dark"><?php echo $x + 1; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <?php
                            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE 
                            `user_email`='" . $selected_data["email"] . "'");
                            $profile_img_num = $profile_img_rs->num_rows;

                            if ($profile_img_num == 1) {
                                $profile_img_data = $profile_img_rs->fetch_assoc();
                            ?>
                                <img src="<?php echo $profile_img_data["path"]; ?>" style="height: 40px;margin-left: 80px;" />
                            <?php
                            } else {
                            ?>
                                <img src="resource/new_user.svg" style="height: 40px;margin-left: 80px;" />
                            <?php
                            }
                            ?>

                        </div>
                        <div class="col-4 col-lg-2 bg-secondary bg-opacity-25 py-2">
                            <span class="fs-4 text-dark"><?php echo $selected_data["fname"] . " " . $selected_data["lname"]; ?></span>
                        </div>
                        <div class="col-4 col-lg-2 d-lg-block bg-light py-2">
                            <span class="fs-6 "><?php echo $selected_data["email"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-secondary  bg-opacity-25 py-2">
                            <span class="fs-4 text-dark"><?php echo $selected_data["mobile"]; ?></span>
                        </div>
                        <div class="col-2 d-none d-lg-block bg-light py-2">
                            <?php
                            $splitDate = explode(" ", $selected_data["joined_date"]);
                            ?>
                            <span class="fs-4 "><?php echo $splitDate[0]; ?></span>
                        </div>
                        <div class="col-2 col-lg-1 py-2 d-grid">

                            <?php
                                                 
                            
                            if ($selected_data["status_status_id"] == 1) {
                            ?>
                                <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-danger">Block</button>
                            <?php
                            } else {
                            ?>
                                <button id="ub<?php echo $selected_data["email"]; ?>" onclick="blockUser('<?php echo $selected_data['email']; ?>');" class="btn btn-success">Unblock</button>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

            <?php

            }
            ?>

            

            <div onclick="window.location='adminPanel.php'" class="text-end">
                <i class="bi bi-arrow-left-square-fill h1 fixed-top "></i>
            </div>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="script.js"></script>
</body>

</html>