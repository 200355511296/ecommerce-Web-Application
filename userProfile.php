<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Profile | glee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resources/logo.svg" />

</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <?php include "header.php"; ?>

            <?php

            include "connection.php";

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `user` INNER JOIN `gender` ON 
                user.gender_gender_id = gender.gender_id WHERE `email` = '" . $email . "'");

                $image_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='" . $email . "'");

                $address_rs = Database::search("SELECT *FROM `user_has_address` INNER JOIN `city` ON 
                user_has_address.city_city_id = city.city_id INNER JOIN `district` ON 
                city.district_district_id = district.district_id INNER JOIN `province` ON
                district.province_province_id = province.province_id WHERE `user_email`='" . $email . "'");

                $user_details = $details_rs->fetch_assoc();
                $image_details = $image_rs->fetch_assoc();
                $address_details = $address_rs->fetch_assoc();

            ?>
                <div class="col-12 bg-body">

                    <div class="row">

                        <div class="col-12 bg-body border rounded-3 mt-4 mb-4">

                            <div class="row g-2">

                                <div class="col-md-3 border-end  bg-gradient ">

                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5 ">

                                        <?php

                                        if (empty($image_details["path"])) {
                                        ?>
                                            <img src="resource/new_user.svg" class="rounded mt-5" style="width: 150px;" id="img" />
                                        <?php
                                        } else {
                                        ?>
                                            <img src="<?php echo $image_details["path"]; ?>" class="rounded mt-5 " style="width: 150px;" id="img" />

                                        <?php
                                        }


                                        ?>

                                        <span class="h5 fw-bold text-dark  mt-5 mb-2"><?php echo $user_details["fname"] . "   " . "   " . $user_details["lname"] ?></span>
                                        <span class="h5 fw-bold text-dark"><?php echo $user_details["email"] ?></span>

                                        <input type="file" class="d-none" id="profileimage" />
                                        <label for="profileimage" class="btnMain mt-5 " onclick="changeProfileImg();">Update Profile Image</label>

                                    </div>
                                </div>

                                <div class="col-md-9 border-end border-start border-3 h5 " style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">
                                    <div class="p-3 py-5">

                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="fw-bold">Profile Settings</h4>
                                        </div>

                                        <div class="row mt-4">

                                            <div class="col-6">
                                                <label class="form-label">First Name</label>
                                                <input id="fname" type="text" class="form-control" value="<?php echo $user_details["fname"]; ?>" />
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">Last Name</label>
                                                <input id="lname" type="text" class="form-control" value="<?php echo $user_details["lname"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Mobile</label>
                                                <input id="mobile" type="text" class="form-control" value="<?php echo $user_details["mobile"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Password</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" id="ppw" value="<?php echo $user_details["password"]; ?>" readonly />
                                                    <span class="input-group-text bg-secondary" id="basic-addon2">
                                                        <i class="bi bi-eye-slash-fill text-white signout" id="ppb" onclick="showPassword3();"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_details["email"]; ?>" />
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Registered Date</label>
                                                <input type="text" class="form-control" readonly value="<?php echo $user_details["joined_date"]; ?>" />
                                            </div>


                                            <div class="col-12">
                                                <label class="form-label">Address Line 01</label>
                                                <?php if (empty($address_details["line1"])) {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line1" type="text" class="form-control" value="<?php echo $address_details["line1"]; ?>" />
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Address Line 02</label>
                                                <?php if (empty($address_details["line2"])) {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" />
                                                <?php
                                                } else {
                                                ?>
                                                    <input id="line2" type="text" class="form-control" value="<?php echo $address_details["line2"]; ?>" />
                                                <?php
                                                }
                                                ?>
                                            </div>

                                            <?php
                                            $province_rs = Database::search("SELECT * FROM `province`");
                                            $district_rs = Database::search("SELECT * FROM `district`");
                                            $city_rs = Database::search("SELECT * FROM `city`");

                                            ?>

                                            <div class="col-6">
                                                <label class="form-label">Province</label>
                                                <select class="form-select" id="province">
                                                    <option value="0">Select Province</option>
                                                    <?php

                                                    for ($x = 0; $x < $province_rs->num_rows; $x++) {
                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $province_data["province_id"]; ?>" <?php
                                                                                                                        if (!empty($address_details["province_id"])) {
                                                                                                                            if ($province_data["province_id"] == $address_details["province_id"]) {
                                                                                                                        ?> selected <?php                                                        }
                                                                                                                            }
                                                                                                                                    ?>>
                                                            <?php echo $province_data["province_name"]; ?>
                                                        </option>

                                                    <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="col-6">
                                                <label class="form-label">District</label>
                                                <select class="form-select" id="district">
                                                    <option value="0">Select District</option>
                                                    <?php

                                                    for ($x = 0; $x < $district_rs->num_rows; $x++) {
                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>

                                                        <option value="<?php echo $district_data["district_id"]; ?>" <?php
                                                                                                                        if (!empty($address_details["district_id"])) {
                                                                                                                            if ($district_data["district_id"] == $address_details["district_id"]) {
                                                                                                                        ?> selected <?php
                                                                                                                                }
                                                                                                                            }

                                                                                                                                    ?>>
                                                            <?php echo $district_data["district_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="row">

                                                <div class="col-6 col-lg-3">
                                                    <label class="form-label">City</label>
                                                    <select class="form-select" id="city">
                                                        <option value="0">Select city</option>
                                                        <option value="1" id="other" onclick="city();">Other</option>

                                                        <?php

                                                        for ($x = 0; $x < $city_rs->num_rows; $x++) {
                                                            $city_data = $city_rs->fetch_assoc();
                                                        ?>

                                                            <option value="<?php echo $city_data["city_id"]; ?>" <?php
                                                                                                                    if (!empty($address_details["city_id"])) {
                                                                                                                        if ($city_data["city_id"] == $address_details["city_id"]) {
                                                                                                                    ?> selected <?php
                                                                                                                            }
                                                                                                                        }

                                                                                                                                ?>>
                                                                <?php echo $city_data["city_name"]; ?>
                                                            </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>


                                                <div class="col-6">
                                                    <label class="form-label">Postal Code</label>
                                                    <?php
                                                    if (empty($address_details["postal_code"])) {
                                                    ?>
                                                        <input id="pcode" type="text" class="form-control" />
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <input id="pcode" type="text" class="form-control" value="<?php echo $address_details["postal_code"]; ?>" />
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <label class="form-label">Gender</label>
                                                <input type="text" class="form-control" value="<?php echo $user_details["gender_name"] ?>" readonly />
                                            </div>

                                            <div class="col-4 offset-4 d-grid mt-4 ">
                                                <button class="btnSub fw-semibold" onclick="updateProfile();">Update My Profile</button>
                                            </div>

                                        </div>

                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            <?php

            } else {
            ?>
                <div class=" min-vh-100 container-fluid" style="background-color:#dbd4cf ;background-image: linear-gradient(170deg,#dbd4cf 20%,#ffd4a2 80%);">

                    <div class=" col-8 offset-2 align-center align-items-center justify-content-center mt-5   ">

                        <img src="resource/errorpic.png" alt="" class=" border rounded-circle col-4 offset-4 ">

                    </div>

                    <h1 class=" text-center mt-3"> <?php echo ("Please Login or Signup first.");  ?></h1>



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