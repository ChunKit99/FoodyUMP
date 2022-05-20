<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
$cid = $_GET['cid'];
$query = "UPDATE `complaint` SET `complaint_type`='$chooseType',`complaint_desc`='$discriptionComplaint' WHERE `complaint_id` = '$cid'";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='user_complaint.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
