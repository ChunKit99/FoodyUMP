<!-- complaint_insert.php -->
<!-- To insert data of user_complaint_add.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract($_POST);
//$query = "INSERT INTO book (nama,email,tarikh,masa,komen) VALUES('$nama','$email','$tarikh','$masa','$komen')";

$query = "INSERT INTO menucategory(menu_category_id, menu_id, name) VALUES ('$','$staticDate','$staticTime','$chooseType','$descriptionComplaint','In Investigation')";

if (mysqli_query($conn, $query)) {

    echo "<script type='text/javascript'> window.location='user_complaint.php' </script>";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}


?>