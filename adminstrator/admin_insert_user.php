<!-- admin_insert_user.php -->
<!-- To insert data of user_complaint_add.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/FoodyUMP/dbase.php";
include_once($path);

extract($_POST);
//$query = "INSERT INTO book (nama,email,tarikh,masa,komen) VALUES('$nama','$email','$tarikh','$masa','$komen')";
$query = "INSERT INTO `user`(`name`, `user_type`, `username`, `password`, `email`, `contact_num`, `state`, `district`, `postal_code`, `details_add`, `gender`) VALUES ('$name','$userType','$userName','$password', '$userEmail', '$contactNum', '$state', '$district', '$postalCode', '$detailsAdd', '$gender')";
$userID="0";
if (mysqli_query($conn, $query)) {
    $q1= "SELECT * FROM `user` WHERE `userName` LIKE  '$userName'";
    $r1 = (mysqli_query($conn, $q1));
    $rs1 = mysqli_fetch_array($r1);
    if($rs1){
        $userID = $rs1['user_id'];
    }
    if($userType=="rider"){
        header("Location: generate_rider.php?id=$userID");
    }else if($userType=="restaurant"){
        header("Location: generate_restaurant.php?id=$userID&name=$name");
    }else{

    }
    echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
?>