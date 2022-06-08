<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);

$query = "UPDATE `rider` SET `plate_no`='$plate_no' WHERE `rider_id` = '$user_id'";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='rider_home.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>