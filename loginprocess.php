<?php
session_start();
include("dbase.php");

if (isset($_REQUEST['sub'])) {
    $a = $_REQUEST['username'];
    $b = $_REQUEST['password'];
    $c = $_REQUEST['userType'];
	
    $res = mysqli_query($conn, "select * from user where username='$a'and password='$b' and user_type = '$c'");
    $result = mysqli_fetch_array($res);
    if ($result) {
        $_SESSION["login"] = "1";
        $_SESSION["username"] = $result['name'];
        $_SESSION["user_id"] = $result['user_id'];
        $_SESSION["user_type"] = $result['user_type'];
        if ($c == "administrator") {
    	header('Location: adminstrator/admin_home.php');
        } else if ($c == "restaurant") {
            header("Location: restaurant/restaurant_profile.php");
        } else if ($c == "generaluser") {
            header("Location: general_user/views/user_home.php");
        } else if ($c == "rider") {
            header("Location: rider/rider_home.php");
        } else {
            header("Location: login.php?err=1");
        }
    } else {
        header("Location: login.php?err=1");
    }
}
?>