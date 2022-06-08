<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$query = "INSERT INTO bankaccount(rider_id, account_number, account_name) VALUES ('$riderID', '$accountNumber','$accountName')";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='rider_home.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>