<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
$user_id = $_GET['id'];
$query = "DELETE FROM rider WHERE `rider_id` = $user_id";
mysqli_query($conn, $query);
$query2 = "DELETE FROM `user` WHERE `user_id`='$user_id' ";
mysqli_query($conn, $query2);
echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";

?>