<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);

$orderStatus = $_GET['order_status'];
$paidStatus = $_GET['paid_status'];
$orderID = $_GET['order_id'];

$query = "UPDATE `orderlist` SET `order_status`='$orderStatus', `paid_status`='$paidStatus' WHERE `order_id` = '$orderID'";

if (mysqli_query($conn, $query)) {
    $file_pointer = "./qrcode/qr_$orderID.png";
  
    // Use unlink() function to delete a file
    if (!unlink($file_pointer)) {
        echo ("$file_pointer cannot be deleted due to an error");
    }
    else {
        echo ("$file_pointer has been deleted");
    }

    echo "<script type='text/javascript'> window.location='../thankyou.html' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>