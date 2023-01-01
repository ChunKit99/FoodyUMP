<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);

extract($_POST);
$userID=$_GET['user_id'];
$query = "UPDATE user SET `name` = '$name' ,`user_type` ='$userType',`username`='$userName',`password`='$password',`email`='$userEmail',`contact_num`='$contactNum',`state`='$state',`district`='$district',`postal_code`='$postalCode',`details_add`='$detailsAdd',`gender`='$gender' WHERE `user_id` = '$userID' ";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}?>