<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="rider")
    header("location:/logout.php");
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/FoodyUMP/assets/css/global.css">
        <link rel="stylesheet" href="/FoodyUMP/assets/css/rider.css">
        <script src="/FoodyUMP/assets/js/rider_qr.js"></script>
        <script src="/FoodyUMP/assets/js/admin.js"></script>
        <title>Rider Order Details</title>
    </head>

    <!--body-->
    
    <body>
        <div id="logo">
            <div class="container-width">
                <div class="fl logo">
                    <img src="/FoodyUMP/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
                </div>
                <div class="topright-container fr">
                    <h3><?php echo $_SESSION['username'] ?></h3>
                    <a href="/FoodyUMP/logout.php"><button class="logout">Logout</button></a>
                </div>
            </div>
        </div>

        <div id="nav-container">
            <div class="container-width nav-container">
                <a href="rider_home.php" class="">Home</a>
                <a href="rider_order.php" class="" style="background: #11767ca6;">Order</a>
                <a href="rider_delivery_record.php" class="">Records</a>
                <a href="rider_report.php" class="">Report</a>
                <a href="rider_complaint.php" class="">Complaint</a>
            </div>
        </div>

        <!--to include the dbase.php-->
        <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/FoodyUMP/dbase.php";
            include_once($path);
            $orderID = $_GET['order_id'];

            $query = "SELECT orderlist.*, restaurant.name AS resName, restaurant.location, restaurant.contact_num AS resContactNum, user.name AS userName, user.contact_num AS userContactNum, user.details_add, menuitem.name AS menuName FROM `orderlist` 
                        JOIN `restaurant` ON orderlist.restaurant_id=restaurant.restaurant_id 
                        JOIN `user` ON orderlist.user_id=user.user_id 
                        JOIN `menuitem` ON orderlist.menu_item_id=menuitem.menu_item_id
                        WHERE orderlist.order_id = '$orderID'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result)){
                    $orderID = $row['order_id'];
                    $orderDate = $row['order_date'];
                    $orderTime = $row['order_time'];
                    $restaurantName = $row['resName'];
                    $restaurantContactNum = $row['resContactNum'];
                    $restaurantLocation = $row['location'];
                    $foodOrder = $row['menuName'];
                    $quantity = $row['quantity'];
                    $customerName = $row['userName'];
                    $customerAddress = $row['delivery_address'];
                    $orderStatus = $row['order_status'];
                    $totalAmount = $row['price'];
                    $paidStatus = $row['paid_status'];
                }
            }
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Order Details</h1>

                <form method="post" action="rider_update_delivery_notes_details_view_more.php">
                    <table class="orderDetail">
                        <tr>
                            <th><label for="orderID">Order ID:</label></th>
                            <td><input type="text" readonly class='rider_input' id="orderID" name="orderID" value="<?php echo $orderID;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="orderDate">Order Date:</label></th>
                            <td><input type="text" readonly class='rider_input' id="orderDate" name="orderDate" value="<?php echo $orderDate;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="orderTime">Order Time:</label></th>
                            <td><input type="text" readonly class='rider_input' id="orderTime" name="orderTime" value="<?php echo $orderTime;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="restaurantName">Restaurant Name:</label></th>
                            <td><input type="text" readonly class='rider_input' id="restaurantName" name="restaurantName" value="<?php echo $restaurantName;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="restaurantContactNum">Restaurant Contact Number:</label></th>
                            <td><input type="text" readonly class='rider_input' id="restaurantContactNum" name="restaurantContactNum" value="<?php echo $restaurantContactNum;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="restaurantLocation">Restaurant Location:</label></th>
                            <td><input type="text" readonly class='rider_input' id="restaurantLocation" name="restaurantLocation" value="<?php echo $restaurantLocation;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="foodOrder">Food Order:</label></th>
                            <td><input type="text" readonly class='rider_input' id="foodOrder" name="foodOrder" value="<?php echo $foodOrder;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="quantity">Quantity:</label></th>
                            <td><input type="text" readonly class='rider_input' id="quantity" name="quantity" value="<?php echo $quantity;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="customerName">Customer Name:</label></th>
                            <td><input type="text" readonly class='rider_input' id="customerName" name="customerName" value="<?php echo $customerName;?>"></td>
                        </tr>
                        <tr>
                            <th><label for="customerAddress">Customer Address:</label></th>
                            <td><input type="text" readonly class='rider_input' id="customerAddress" name="customerAddress" value="<?php echo $customerAddress;?>"></td>
                        </tr>
                        <tr>
                            <th>Order Status:</th>
                            <td>
                                <select class='rider_input' name="orderStatus" id="orderStatus">
                                    <?php
                                        $orderStatusTypes = array('Picked Up');

                                        foreach ($orderStatusTypes as $orderStatusType){
                                            if ($orderStatus == $orderStatusType) {
                                                echo "<option selected value='$orderStatusType'>$orderStatusType</option>";
                                            } else {
                                                echo "<option value='$orderStatusType'>$orderStatusType</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="totalAmount">Total Amount:</label></th>
                            <td><input type="text" readonly class='rider_input' id="totalAmount" name="totalAmount" value="<?php echo $totalAmount;?>"></td>
                        </tr>
                        <tr>
                            <th>Paid Status:</th>
                            <td>
                                <select class='rider_input' name="paid_status" id="paid_status">
                                    <?php
                                        $paidStatusTypes = array('Unpaid', 'Paid');

                                        foreach ($paidStatusTypes as $paidStatusType){
                                            if ($paidStatus == $paidStatusType) {
                                                echo "<option selected value='$paidStatusType'>$paidStatusType</option>";
                                            } else {
                                                echo "<option value='$paidStatusType'>$paidStatusType</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <div class="div1">
                        <input type="submit" class="button1" value="Update"></input>
                        <a href="rider_order.php"><button type="button" class="button1">Cancel</button></a>
                    </div>
                </form>

                
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

    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>Please scan the QR Code to confirm the delivery.</p>
      <img src="QR2.jpg" alt="QR Code" width="100" height="100">
    </div>
  
  </div>

  
</html>