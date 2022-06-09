<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);

$userID = $_GET['user_id'];

$query = "DELETE FROM `user` WHERE `user_id`='$userID' ";

$q1= "SELECT * FROM `user` WHERE `user_id`='$userID'";
$r1 = (mysqli_query($conn, $q1));
$rs1 = mysqli_fetch_array($r1);
if($rs1){
    $user_type = $rs1['user_type'];
    if($user_type=="rider"){
        header("Location: delete_rider.php?id=$userID");
    }else if($user_type=="restaurant"){
        header("Location: delete_restaurant.php?id=$userID");
    }else{

    }
}

if (mysqli_query($conn, $query)) {
    echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}?>