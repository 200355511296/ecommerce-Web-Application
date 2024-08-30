<?php

include "connection.php";

$email = $_POST["e"];
$newpw = $_POST["n"];
$retypepw = $_POST["r"];
$vcode = $_POST["v"];


if (empty($email)) {
    echo ("Plese Enter Your Email Address.");
} else if (strlen($email) > 100) {
    echo ("Email Address Must Contain LOWER THAN 100 charactors");
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("Invalid Email Address.");
} else if (empty($newpw)) {
    echo ("Please Enter Your New Password.");
} else if (strlen($newpw) < 5 || strlen($newpw) > 20) {
    echo ("Password Must Contain 5 to 20 Characters.");
}else  if (empty($vcode)) {
    echo ("Plese Enter Verification Code.");
}else if($newpw != $retypepw){
    echo ("Password does not match.");
}else{

    $rs = Database::search("SELECT * FROM `user` WHERE `email`='".$email."' AND `verification_code`='".$vcode."'");
    $num = $rs->num_rows;

    if($num == 1){

        Database::iud("UPDATE `user` SET `password`='".$retypepw."' WHERE `email`='".$email."'");
        echo ("success");

    }else{
        echo ("Invalid Email Address or Verification Code");
    }

}

?>