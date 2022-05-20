<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);


$complaintid = $_GET['cid'];
$query = "DELETE FROM `complaint` WHERE `complaint_id` = '$complaintid'";
if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='user_complaint.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>