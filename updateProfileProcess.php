<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$fname = $_POST["f"];
$lname = $_POST["l"];
$mobile = $_POST["m"];
$line1 = $_POST["l1"];
$line2 = $_POST["l2"];
$provine = $_POST["p"];
$district = $_POST["d"];
$city = $_POST["c"];
$pcode = $_POST["pc"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");

if($user_rs->num_rows == 1){

    if (empty($fname)) {
        echo ("Plese Enter Your First Name.");
    } else if (strlen($fname) > 50) {
        echo ("First Name Must Contain LOWER THAN 50 Characters.");
    }else if (empty($lname)) {
        echo ("Plese Enter Your Last Name.");
    } else if (strlen($lname) > 50) {
        echo ("Last Name Must Contain LOWER THAN 50 Characters.");
    }else if (empty($mobile)) {
        echo ("Please Enter Your Mobile Number.");
    } else if (strlen($mobile) != 10) {
        echo ("Mobile Number Must Contain 10 characters.");
    } else if (!preg_match ( "/07[0,1,2,4,5,6,7,8]{1}[0-9]{7}/" , $mobile)) {  
        echo ("Invalid Mobile Number.");
    }else if (empty($line1)) {
        echo ("Plese Enter Address Line 01");
    } else if (empty($line2)) {
        echo ("Plese Enter Address Line 02");
    }else if (empty($provine)) {
        echo ("Plese Enter provinece");
    }else if (empty($district)) {
        echo ("Plese Enter district");
    }else if (empty($city)) {
        echo ("Plese Enter city");
    
    }else{     
        
        
    
    Database::iud("UPDATE `user` SET `fname`='".$fname."',`lname`='".$lname."',`mobile`='".$mobile."' WHERE 
     `email`='".$email."'");

    $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email`='".$email."'");


    if($address_rs->num_rows == 1){

        Database::iud("UPDATE `user_has_address` SET `city_city_id`='".$city."',`line1`='".$line1."',
        `line2`='".$line2."',`postal_code`='".$pcode."' WHERE `user_email`='".$email."'");

    } else if($address_rs->num_rows == 1){

        Database::iud("UPDATE `user_has_address` SET `city_city_id`='".$city."',`line1`='".$line1."',
        `line2`='".$line2."',`postal_code`='".$pcode."' WHERE `user_email`='".$email."'");

    }else if($city == 1 ){

        Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_city_id`,`line1`,`line2`,`postal_code`) 
        VALUES ('".$email."','".$city."','".$line1."','".$line2."','".$pcode."')");

    }else{

        Database::iud("INSERT INTO `user_has_address`(`user_email`,`city_city_id`,`line1`,`line2`,`postal_code`) 
        VALUES ('".$email."','".$city."','".$line1."','".$line2."','".$pcode."')");

        

    }

    if(sizeof($_FILES) == 1){

        $image = $_FILES["i"];
        $image_extension = $image["type"];

        $allowed_image_extensions = array("image/jpeg","image/png","image/svg+xml");

        if(in_array($image_extension,$allowed_image_extensions)){
            $new_img_extension;

            if($image_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($image_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($image_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "resource//profile_images//".$fname."_".uniqid().$new_img_extension;
            move_uploaded_file($image["tmp_name"],$file_name);

            $profile_img_rs = Database::search("SELECT * FROM `profile_img` WHERE `user_email`='".$email."'");

            if($profile_img_rs->num_rows == 1){

                Database::iud("UPDATE `profile_img` SET `path`='".$file_name."' WHERE `user_email`='".$email."'");
                echo ("Updated");

            }else{

                Database::iud("INSERT INTO `profile_img`(`path`,`user_email`) VALUES ('".$file_name."','".$email."')");
                echo ("Saved");

            }

        }

      
    }else if(sizeof($_FILES) == 0){

        echo ("You have not selected any image.");

    }else{
        echo ("You must select only 01 profile image.");
    }
}

}else{
    echo ("Invalid user.");
}

?>