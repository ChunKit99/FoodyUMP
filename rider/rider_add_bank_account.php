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
        <title>Rider Add Bank Account</title>
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
                <a href="rider_order.php">Order</a>
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
            $userID = $_SESSION["user_id"];
            $riderID = "";

            //find rider base on rider id
            $query = "SELECT * FROM `rider` WHERE `rider_id` = '$userID' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_array($result)){
                    $riderID = $row['rider_id'];
                }
            } else {
                $riderID = "Undefine name, an error on database";
            }
            
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">

                <h1>Add Bank Account</h1>

                <form method="post" action="rider_insert_bank_account.php">
                    <table class="rider_profile">
                        <tr>
                            <td><label for="riderID">Rider ID:</label></td>
                            <td><input type="text" readonly class='rider_input' id="riderID" name="riderID" value="<?php echo $riderID;?>"></td>
                        </tr>
                        <tr>
                            <td><label for="accountNumber">Account Number:</label></td>
                            <td><input type="text" class='rider_input' id="accountNumber" name="accountNumber" required></td>
                        </tr>
                        <tr>
                            <td><label for="accountName">Account Name: </label></td>
                            <td><input type="text" class='rider_input' id="accountName" name="accountName" required></td>
                        </tr>
                        
                    </table>
                    <div class="div1">
                        <input type="submit" class="button1" value="Add"></input>
                        <a href="rider_home.php"><button type="button" class="button1">Cancel</button></a>
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

</html>