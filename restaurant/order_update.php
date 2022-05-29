<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$orderId = $_GET['id'];
$query = "UPDATE `orderlist` SET `order_status`='$f_Status' WHERE `order_id` = '$orderId'";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='restaurant_order.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}