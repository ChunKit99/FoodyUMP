<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
$user_id = $_GET['id'];
$query = "INSERT INTO `rider` (`rider_id`, `plate_no`) VALUES ('$user_id', '')";
mysqli_query($conn, $query);
echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";

?>