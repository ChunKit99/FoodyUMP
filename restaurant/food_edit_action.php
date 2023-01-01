<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);

extract($_POST);
$menuItemId = $_GET['id'];
$query = "UPDATE `menuitem` SET `name`='$name',`description`='$description',`price`='$price',`photo`='$photo', 
`photo`='$photo' WHERE `menu_item_id` = '$menuItemId'";

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='restaurant_food.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}?>