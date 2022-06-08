<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);

$cart_id=$_GET["cart_id"];

$query = "DELETE FROM `cartorder` WHERE `cart_id` = '$cart_id'";
if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='user_order.php'</script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>