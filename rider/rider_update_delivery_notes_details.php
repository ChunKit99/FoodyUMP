<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

$orderStatus = $_GET['order_status'];
$paidStatus = $_GET['paid_status'];
$orderID = $_GET['order_id'];

$query = "UPDATE `orderlist` SET `order_status`='$orderStatus', `paid_status`='$paidStatus' WHERE `order_id` = '$orderID'";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='rider_order.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>