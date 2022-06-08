<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="restaurant")
    header("location:/logout.php");
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/restaurant.css">
        <script src="/assets/js/admin.js"></script>
        <script src="/assets/js/restaurant.js"></script>
        <title>Foody UMP</title>
    </head>

    <!--body-->
    
    <body>
        <div id="logo">
            <div class="container-width">
                <div class="fl logo">
                    <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
                </div>
                <div class="topright-container fr">
                <h3><?php echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
                </div>
            </div>
        </div>


        <div id="nav-container">
            <div class="container-width nav-container">
                <a href="restaurant_profile.php" class="" >Home</a>
                <a href="restaurant_food.php" class="">Food</a>
                <a href="restaurant_order.php" class="">Order</a>
                <a href="restaurant_report.php" class="">Report</a>
            </div>
        </div>

        <?php
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/dbase.php";
        include_once($path);
        $userid = $_SESSION["user_id"];
        $restaurantid= $_SESSION["restaurant_id"];
        $orderId=$_GET["id"];


        $orderD = "SELECT orderlist.*, menuitem.menu_item_id, menuitem.name AS `fName` FROM `orderlist` JOIN `menuitem` ON 
        orderlist.menu_item_id = menuitem.menu_item_id WHERE `order_id` = $orderId";
        $result = mysqli_query($conn, $orderD);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $foodName=$row["fName"];
                $orderId = $row["order_id"];
                $userId = $row["user_id"];
                $riderId = $row["rider_id"];
                $restaurentId = $row["restaurant_id"];
                $menuItemId = $row["menu_item_id"];
                $deliveryAddress = $row["delivery_address"];
                $quantity = $row["quantity"];
                $orderStatus = $row["order_status"];
                $paidStatus = $row["paid_status"];
                $orderDate = $row["order_date"];
                $orderTime = $row["order_time"];
                $price = $row["price"];
            }}
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Order Details</h1>

                <form action="order_update.php?id=<?php echo $orderId ?>" method="post">
                <table class="orderDetail">
                    <tr>
                        <th>Order Number:</th>
                    </tr>

                        <tr>
                           <td><?php echo $orderId ?></td>
                        </tr>
                        
                        <tr>
                            <th>Food Order:</th>
                            <th>Quantity</th>
                        </tr>

                        <tr>
                            <td><?php echo $foodName ?></td>
                            <td><?php echo $quantity ?></td>
                        </tr>

                        <tr>
                            <th>Deliver Address:</th>
                        </tr>

                        <tr>
                            <td><?php echo $deliveryAddress ?></td>
                        </tr>

                        <tr>
                        <th>Rider:</th>
                    </tr>

                    <tr>
                        <td>
                            <?php
                                echo "<select name='f_rider' id='food_catagory' >";
                        $riderdetail = "SELECT rider.rider_id, user.name, user.user_id FROM `rider` JOIN `user` WHERE rider.rider_id=user.user_id";
                                     $resultname = mysqli_query($conn, $riderdetail);
                                        if (mysqli_num_rows($resultname) > 0) {
                                            while ($row = mysqli_fetch_array($resultname)) {
                                                $riderid = $row["rider_id"];
                                                $ridername=$row["name"];
                                                echo "<option value='$riderid'>$ridername</option>";

                                                  }
                                            }?>
                        </td>
                    </tr>

                    <tr>
                        <th>Status:</th>
                    </tr>

                    <tr>
                        <td><select name="f_Status" id="food_status">
                            <option value="Ordered">Ordered</option>
                            <option value="Prepared" selected>Prepared</option>
                            </select>
                        </td>
                    </tr>

                </table>
                

                <div class="two_button">
                <?php
                echo "<input type='submit' class='btn_update' value='Update'>";
                ?>
                <a href="restaurant_order.php"><button class = "btn_delete">Cancel</button></a>
                </div>
            </div>
        </div>
            </form>

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