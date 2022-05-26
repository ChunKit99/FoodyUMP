<!-- rider_delete_bank_account.php -->
<!-- To insert data of rider_delete_bank_account.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);

$accountID = $_GET['account_id'];
$query = "DELETE FROM `bankaccount` WHERE `account_id` = '$accountID'";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='rider_home.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>