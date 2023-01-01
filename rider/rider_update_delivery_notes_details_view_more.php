<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
extract($_POST);

$query = "UPDATE `orderlist` SET `order_status`='$orderStatus', `paid_status`='$paid_status' WHERE `order_id` = '$orderID'";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='rider_order.php' </script>";
   
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>