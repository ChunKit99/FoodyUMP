<!-- rider_update_delivery_notes_details.php -->
<!-- To insert data of rider_update_delivery_notes_details.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$query = "UPDATE `orderlist` SET `order_status`='$orderStatus', `paid_status`='$paidStatus' WHERE `order_id` = '$orderID'";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='rider_order.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>