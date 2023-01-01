<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
$uid = $_GET['uid'];
$rid = $_GET['rid'];
$query = "INSERT INTO `restaurantowner` (`user_id`, `restaurant_id`) VALUES ('$uid', '$rid')";
mysqli_query($conn, $query);
echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
?>