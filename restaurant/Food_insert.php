<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);

$query = "INSERT INTO menuitem(menu_category_id,`name`,`description`,price,photo,status_available) VALUES ('$f_Catagory'
,'$f_name','$description','$price','$photo','$status_available')";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='restaurant_food.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>