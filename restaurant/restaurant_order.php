<!DOCTYPE html>
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
                    <p>Username</p>
                    <button class="logout" onclick="logout()"> Logout</button>
                </div>
            </div>
        </div>

        <div id="nav-container">
            <div class="container-width nav-container">
                <a href="restaurant_profile.php" class="" >Home</a>
                <a href="restaurant_food.php" class="">Food</a>
                <a href="restaurant_order.php" class="" style="background: #11767ca6;">Order</a>
                <a href="restaurant_report.php" class="">Report</a>
            </div>
        </div>

        <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);
    $userid = "3";
    $restaurantid="1";

    //find menuCatagory using menu id
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Order Received</h1>

                <table class="orderList">
                    <tr>
                        <th>Order number</th>
                        <th>Status</th>
                        <th>Price (RM)</th>
                        <th>Rider</th>
                    </tr>
                    
                        <?php
                            $riderL = "SELECT orderlist.*, rider.rider_id, user.user_id, user.name AS rName FROM `orderlist` JOIN `rider` ON 
                            orderlist.rider_id = rider.rider_id JOIN `user` ON rider.rider_id = user.user_id WHERE `restaurant_id` = $restaurantid";
                            $result = mysqli_query($conn, $riderL);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $riderName=$row["rName"];
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
                           
                        echo "<tr>";       
                        echo "<td>";
                        echo "<a href='orderDetail.php?id=".$orderId."'>$orderId</a>";
                        echo "</td>";
                        echo "<td>";
                        echo $orderStatus;
                        echo "</td>";
                        echo "<td>";
                        echo $price;
                        echo "</td>";
                        echo "<td>";
                        echo $riderName;
                        echo "</td>";
                        echo "</tr>";
                            }
                        }
                    
                        ?>
                    </tr>
                   
                </table>
                
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
