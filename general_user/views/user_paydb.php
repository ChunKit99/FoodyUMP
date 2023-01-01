<?php       
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/FoodyUMP/dbase.php";
            include_once($path);

            session_start();
            if (!isset($_SESSION["login"]))
            header("location:/login.php");
            if($_SESSION["user_type"]!="generaluser")
            header("location:/FoodyUMP/logout.php");

            extract($_POST);

            $userid =$_SESSION['user_id'];
            $cart_id = $_GET['cart_id'];
            $idshop = $_GET['idshop'];
            $itemid=$_GET['itemid'];
            $price=$_GET['price']; 
            $quantity=$_GET['quantity'];
            $date= date('Y-m-d');
            $time=date('H:i:s');

            $query = "INSERT INTO orderlist (`user_id`,`rider_id`, `restaurant_id`, `menu_item_id`, `delivery_address`, `phone`, `quantity`, `order_status`, `paid_status`, `order_date`, `order_time`, `price`) VALUE ('$userid','0','$idshop','$itemid','$address','$phone','$quantity','Ordered','Unpaid','$date','$time','$price')"; 
            if (mysqli_query($conn, $query)) {
                //echo "<script type='text/javascript'> window.location='user_delivery.php'></script>";
                
                header("location:user_cartdelete.php?cart_id=$cart_id");
            } 
            else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
?>