<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["clr"];
$qty = $_POST["q"];
$cost = $_POST["co"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["de"];

if (empty($category)) {
    echo ("Plese Enter Product category.");
} else if (empty($title)) {
    echo ("Plese Enter Product Title.");
} else if (empty($condition)) {
    echo ("Plese Add Product Condition.");
} else if (empty($clr)) {
    echo ("Plese Add Product Color.");
}else if (empty($qty)) {
    echo ("Plese Add Product Quantity.");
}else if (empty($cost)) {
    echo ("Plese Add Product Cost Per Item.");
}else if (empty($dwc)) {
    echo ("Plese Add Product Delivery Cost Within Colombo.");
}else if (empty($doc)) {
    echo ("Plese Add Product Delivery Cost Out Of Colombo.");
}else if (empty($desc)) {
    echo ("Plese Add Product Description.");
}else {         

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d H:i:s");

$status = 1;

Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
`delivery_fee_other`,`category_cat_id`,`condition_condition_id`,`status_status_id`,`user_email`) 
VALUES ('".$cost."','".$qty."','".$desc."','".$title."','".$date."','".$dwc."','".$doc."',
'".$category."','".$condition."','".$status."','".$email."')");

$product_id = Database::$connection->insert_id;

$product_rs = Database::search("SELECT * FROM `product`");
$product_data = $product_rs->fetch_assoc();
$pid = $product_data["id"];

$color_rs = Database::search("SELECT * FROM `color`");
$color_data = $color_rs->fetch_assoc();
$c_id = $color_data["clr_id"];





Database::iud("INSERT INTO product_has_color (`color_clr_id`,`product_id`) VALUES 
 ('".$c_id."','".$pid."')");


$length = sizeof($_FILES);

if($length <= 3 && $length > 0){

    $allowed_image_extensions = array ("image/jpeg","image/png","image/svg+xml");

    for($x = 0;$x < $length;$x++){
        if(isset($_FILES["image".$x])){

            $image_file = $_FILES["image".$x];
            $file_extension = $image_file["type"];

            if(in_array($file_extension,$allowed_image_extensions)){

                $new_img_extension;

            if($file_extension == "image/jpeg"){
                $new_img_extension = ".jpeg";
            }else if($file_extension == "image/png"){
                $new_img_extension = ".png";
            }else if($file_extension == "image/svg+xml"){
                $new_img_extension = ".svg";
            }

            $file_name = "resource//images//".$title."_".$x."_".uniqid().$new_img_extension;
            move_uploaded_file($image_file["tmp_name"],$file_name);

            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES 
            ('".$file_name."','".$product_id."')");

            }else{
                echo ("Inavid image type.");
            }

        }
    }

    echo ("success");

}else{
    echo ("Invalid Image Count.");
}

}

?>