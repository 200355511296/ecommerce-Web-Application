<?php

session_start();
include "connection.php";

$sender = $_SESSION["u"]["email"];
$recever = $_POST["rm"];
$msg = $_POST["mt"];
$select_user = $_POST["su"];

if (empty($select_user)) {
    echo ("Plese Select User");
}else if (empty($msg)) {
    echo ("Plese write massagr");
} else {
    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    
    Database::iud("INSERT INTO `chat`(`content`,`date_time`,`status`,`from`,`to`) VALUES 
    ('".$msg."','".$date."','0','".$sender."','".$recever."')");
    
    echo ("success");}



?>