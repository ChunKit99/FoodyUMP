<!-- complaint_insert.php -->
<!-- To insert data of user_complaint_add.php into database. -->
<?php

$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/dbase.php";
include_once($path);

extract( $_POST );
$tarikh = date("d-m-Y", time());
$masa = date("H:i:s", time());
$query = "INSERT INTO book (nama,email,tarikh,masa,komen) VALUES('$nama','$email','$tarikh','$masa','$komen')";

if (mysqli_query($conn, $query)) {
      
   echo "<script type='text/javascript'> window.location='papar.php' </script>";
	
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}




?>