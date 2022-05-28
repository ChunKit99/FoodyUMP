<?php
session_start ();
session_destroy();
if (isset($_REQUEST["inv"]))
    header("location:login.php?inv=1");
header("location:login.php");
?>