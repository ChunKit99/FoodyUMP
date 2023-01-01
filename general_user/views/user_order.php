<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="generaluser")
    header("location:/logout.php");
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/global.css">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/general.css">
    <script src="/FoodyUMP/assets/js/admin.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script src="/FoodyUMP/assets/js/bootstrap.min.js"></script>
    <script src="/FoodyUMP/assets/js/popper.min.js"></script>
    <script src="/FoodyUMP/assets/js/admin.js"></script>



    <title>Foody UMP</title>
</head>

<!--body-->

<body>

    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/FoodyUMP/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/FoodyUMP/dbase.php";
                    include_once($path);
                    echo $_SESSION['username']; 
                    $user_id = $_SESSION['user_id'];?></h3>
                <a href="/FoodyUMP/logout.php"><button class="logout">Logout</button></a>
            </div>
        </div>
    </div>
    <div id="nav-container">
        <div class="container-width nav-container">
            <a href="user_home.php" class="">Home</a>
            <a href="user_order.php" class="" style="background: #11767ca6;">Order</a>
            <a href="user_delivery.php" class="">Delivery</a>
            <a href="user_expenses.php" class="">Expenses</a>
            <a href="user_report.php" class="">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--woeichi-->
            <div class="ordering">
                <br><br><br>
                <h1>My Order List</h1>
            </div>
            <br><br>

            <div class="orderlist">
                <table>
                    <tr>
                        <th>Food Name</th>
                        <th>Food Description</th>
                        <th>Price Per Item (RM)</th>
                        <th>Quantity</th>
                        <th>Action</th>

                    </tr>
                    <?php 
                    $user_id=$_SESSION['user_id'];
                    $cart2="SELECT * FROM `cartorder` JOIN `menuitem` ON menuitem.menu_item_id=cartorder.menu_item_id AND cartorder.user_id = $user_id ORDER BY `cart_id` DESC";
                    $result= mysqli_query($conn, $cart2);
                    if (mysqli_num_rows($result) > 0){

                        while ($row = mysqli_fetch_assoc($result)) {
                            $cart_id=$row['cart_id'];
                            $foodname = $row['name'];
                            $fooddes = $row['description']; 
                            $foodprice = $row['price']; 
                            $quantity=$row['quantity']; 
                            
                            echo "<tr>";
                            echo "<td>$foodname </td>";
                            echo "<td>$fooddes </td>";
                            echo "<td>$foodprice </td>";
                            echo "<td><input type='number' readonly id='quantity' value='$quantity'></td>";

                            echo "<td>
                                    <a href='user_order_edit.php'><button class='editbutton' class='btn btn-info btn-lg'>EDIT</button></a>
                                    <a href='user_cartdelete.php?cart_id=".$cart_id."'><button class='deletebutton'>DELETE</button></a>
                                    <a href='user_payment.php?cart_id=".$cart_id."'><button class='checkbutton'>CHECKOUT</button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </div>
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