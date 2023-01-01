<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);
$user_id = $_GET['id'];
$name = $_GET['name'];
$query = "INSERT INTO `restaurant` (`restaurant_id`, `name`, `location`, `operation_time`, `contact_num`, `instagram`) VALUES (NULL, '$name', '', '', '', '')";
mysqli_query($conn, $query);
$q1 ="SELECT * FROM `restaurant` WHERE `name`='$name'";
$r1 = (mysqli_query($conn, $q1));
$rs1 = mysqli_fetch_array($r1);
$res_id = $rs1['restaurant_id'];
header("Location: generate_restaurant_owner.php?uid=$user_id&rid=$res_id");
?>