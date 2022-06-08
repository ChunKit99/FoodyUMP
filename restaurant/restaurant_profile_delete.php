<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$restaurantid = $_GET['id'];

if(isset($_POST['res_pro_name'])){
    $name='';
}
if(isset($_POST['res_pro_location'])){
    $location='';
}
if(isset($_POST['res_pro_operation'])){
    $operation_time='';
}
if(isset($_POST['res_pro_contact'])){
    $contact_num='';
}
if(isset($_POST['res_pro_insta'])){
    $instagram='';
}

$query = "UPDATE `restaurant` SET `name`='$name',`location`='$location',`operation_time`='$operation_time',`contact_num`='$contact_num',`instagram`='$instagram' WHERE `restaurant_id` = '$restaurantid'";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='restaurant_profile.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}?>