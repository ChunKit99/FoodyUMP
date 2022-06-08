<!-- rider_update_plate_no.php -->
<!-- To insert data of rider_update_plate_no.php into database. -->
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