<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$restaurantid = $_GET['id'];
$query = "UPDATE `restaurant` SET `name`='$name',`location`='$location',`operation_time`='$operation_time',`contact_num`='$contact_num',`instagram`='$instagram' WHERE `restaurant_id` = '$restaurantid'";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='restaurant_profile.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}?>