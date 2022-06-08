<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/rider.css">
        <script src="/assets/js/rider_qr.js"></script>
        <script src="/assets/js/admin.js"></script>
        <title>Rider Delivery Records</title>
    </head>

    <!--body-->
    <?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="rider")
    header("location:/logout.php");
?>
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
                <a href="rider_home.php" class="">Home</a>
                <a href="rider_order.php" class="">Order</a>
                <a href="rider_delivery_record.php" class="" style="background: #11767ca6;">Records</a>
                <a href="rider_report.php" class="">Report</a>
                <a href="rider_complaint.php" class="">Complaint</a>
            </div>
        </div>

        <!--to include the dbase.php-->
        <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/dbase.php";
            include_once($path);

            $userID = $_SESSION["user_id"];
            $riderID = "";

            $q = "SELECT * FROM `rider` WHERE `rider_id` = '$userID'";
            $res = mysqli_query($conn, $q);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $riderID = $row['rider_id'];
                    
                }
            }

            $query = "SELECT * FROM `orderlist` 
                        JOIN restaurant ON orderlist.restaurant_id=restaurant.restaurant_id 
                        WHERE orderlist.order_status = 'Completed'";
            $result = mysqli_query($conn, $query);
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Delivery Notes</h1>
                <table class="delivery_notes">
                    <tr>
                        <th>Order ID</th>
                        <th>Order Status</th>
                    </tr>
                    <?php
                        $count = 0;
                        if (mysqli_num_rows($result) > 0){
                            //output data of each row
                            while ($row = mysqli_fetch_assoc($result)){
                                $count++;
                                $orderID = $row['order_id'];
                                $orderStatus = $row['order_status'];
                                echo "<tr>";
                                echo "<td scope='row'>$orderID</td>";
                                echo "<td>$orderStatus</td>";
                                echo "<td>";
                            ?>

                    <?php
                            }
                        }
                    ?>
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
