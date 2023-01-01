<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
$user_id = $_GET['id'];
$q1= "SELECT * FROM `restaurantowner` WHERE `user_id`='$user_id'";
$r1 = mysqli_query($conn, $q1);
$rs1 = mysqli_fetch_array($r1);
$restaurant_id=$rs1['restaurant_id'];

$query3 = "DELETE FROM restaurantowner WHERE `user_id` = '$user_id'";
mysqli_query($conn, $query3);
$query = "DELETE FROM restaurant WHERE `restaurant_id` = $restaurant_id";
mysqli_query($conn, $query);

$query2 = "DELETE FROM `user` WHERE `user_id`='$user_id' ";
mysqli_query($conn, $query2);
echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";

?>