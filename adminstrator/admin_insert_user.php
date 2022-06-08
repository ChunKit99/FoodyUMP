<!-- admin_insert_user.php -->
<!-- To insert data of user_complaint_add.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
//$query = "INSERT INTO book (nama,email,tarikh,masa,komen) VALUES('$nama','$email','$tarikh','$masa','$komen')";
$query = "INSERT INTO `user`(`name`, `user_type`, `username`, `password`, `email`, `contact_num`, `state`, `district`, `postal_code`, `details_add`, `gender`) VALUES ('$name','$userType','$userName','$password', '$userEmail', '$contactNum', '$state', '$district', '$postalCode', '$detailsAdd', '$gender')";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='admin_user_list.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>
