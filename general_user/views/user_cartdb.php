<?php       
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/dbase.php";
            include_once($path);

            session_start();
            if (!isset($_SESSION["login"]))
            header("location:/login.php");
            if($_SESSION["user_type"]!="generaluser")
            header("location:/logout.php");


            extract($_POST);
            $userid = $_SESSION['user_id'];

            $idshop=$_GET['idshop'];
            $menu_category_id=$_GET['menu_category_id'];
            $itemid=$_GET['itemid'];
            $query = "INSERT INTO cartorder (`user_id`,`menu_item_id`,`quantity`) VALUE ('$userid','$itemid','$quantity')"; 
            if (mysqli_query($conn, $query)) {
                //echo "<script type='text/javascript'> window.location='user_order.php'></script>";
                header("location:user_order.php");
            } 
            else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
?>