<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);


$query = "INSERT INTO menucategory(`restaurant_id`, `name`) VALUES ('$restaurant_id','$name')";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='restaurant_food.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>