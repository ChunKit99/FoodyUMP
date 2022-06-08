<!-- admin_insert_user.php -->
<!-- To insert data of user_complaint_add.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
//$query = "INSERT INTO book (nama,email,tarikh,masa,komen) VALUES('$nama','$email','$tarikh','$masa','$komen')";
$query = "INSERT INTO `user`(`name`, `user_type`, `username`, `password`, `email`, `contact_num`, `state`, `district`,
 `postal_code`, `details_add`, `gender`) VALUES ('$name','$userType','$userName','$password', '$userEmail', '$contactNum', '$state', '$district', '$postalCode', '$detailsAdd', '$gender')";

if (mysqli_query($conn, $query)) {
    $q_userID = "SELECT `user_id` FROM `user` WHERE `username` = '$userName'";
    $result = mysqli_query($conn, $q_userID);
            if (mysqli_num_rows($result) > 0) {
                // output data
                while ($row = mysqli_fetch_assoc($result)) {
                    $userIDsearch = $row["user_id"];
                }
            }  
    if($userType=='generaluser'){
        $query2 = "INSERT INTO `generaluser` (`user_id`, `role`) VALUES ('$userIDsearch', 'student')";
    }else if($userType=='restaurant'){
        $q3 = "INSERT INTO `restaurant` (`restaurant_id`, `name`, `location`, `operation_time`, `contact_num`, `instagram`) VALUES (NULL, '$userName shop', '', '', '', '')";
        $query2 = "INSERT INTO `restaurantowner` (`user_id`, `restaurant_id`) VALUES ('$userIDsearch', '')";
    }else if($userType=='rider'){
        $query2 = "INSERT INTO `rider` (`rider_id`, `plate_no`) VALUES ('$userIDsearc', '')";
    }else{
        $query2 = "";
    }
    mysqli_query($conn, $query2);
    echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>
