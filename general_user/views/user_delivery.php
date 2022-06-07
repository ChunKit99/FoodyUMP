<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/general.css">
    <script src="/assets/js/admin.js"></script>
    <title>Foody UMP</title>
</head>

<!--body-->

<body>
    <?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="generaluser")
    header("location:/logout.php");
?>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/dbase.php";
                    include_once($path);
                    echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
            </div>
        </div>
    </div>

    <div id="nav-container">
        <div class="container-width nav-container">
            <a href="user_home.php" class="">Home</a>
            <a href="user_order.php" class="">Order</a>
            <a href="user_delivery.php" class="" style="background: #11767ca6; ">Delivery</a>
            <a href="user_expenses.php" class="">Expenses</a>
            <a href="user_report.php" class="">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--woeichi-->
            <?php
            echo "<div class='tracking'>";
            echo "<br><br><br>";
            echo "<h1>Delivery Status</h1>";
            echo "</div><br><br>";
            echo "<div class='track'>";
            echo "<table><tr>";
            echo "<th>Order Status:</th>";
            echo "<th>Order Number:</th>";
            echo "<th>Food Name:</th>";
            echo "<th>Food Description:</th>";
            echo "<th>Price Per Item:</th>";
            echo "<th>Quantity:</th>";
            echo "<th>Delivery Price:</th>";
            echo "<th>Total Price:</th>";
            echo "</tr>";

            $deli="SELECT orderlist.*, orderlist.price AS totalprice, menuitem.* FROM `orderlist` JOIN `menuitem` ON orderlist.menu_item_id = menuitem.menu_item_id ";
            $result= mysqli_query($conn, $deli);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['order_status'];
                    $orderid = $row['order_id'];
                    $foodname = $row['name'];
                    $fooddes = $row['description']; 
                    $foodprice = $row['price']; 
                    $quantity = $row['quantity']; 
                    $price = $row['totalprice'];
                
                    echo "<tr>";
                    echo "<td>$status</td>";
                    echo "<td>$orderid</td>";
                    echo "<td>$foodname </td>";
                    echo "<td>$fooddes </td>";
                    echo "<td>$foodprice</td>";
                    echo "<td>$quantity</td>";
                    echo "<td>4.00</td>";
                    echo "<td>$price</td>";
                    echo "</tr>";

                }
            }
            echo "</table>";
            echo "</div>";
?>
            <!--woeichi-->
        </div>
    </div>

</body>

<!--footer-->
<div id="footer-container">
    <div class="footer-content">
        <div class="footer-links-a" style="margin-top: 20px"></div>
        <div class="copyright-info">
            <p>CopyRight © 2022 Foody UMP All Right Reserved</p>
        </div>
    </div>
</div>

</html>