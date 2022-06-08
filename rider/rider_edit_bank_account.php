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
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/rider.css">
        <script src="/assets/js/rider_qr.js"></script>
        <script src="/assets/js/admin.js"></script>
        <title>Rider Edit Bank Account</title>
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
            $path .= "/dbase.php";
            include_once($path);
            $accountID = $_GET['account_id'];

            $query = "SELECT * FROM bankaccount WHERE account_id = '$accountID'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0){
                //output data
                while ($row = mysqli_fetch_assoc($result)){
                    $accountID = $row["account_id"];
                    $riderID = $row["rider_id"];
                    $accountNumber = $row["account_number"];
                    $accountName = $row["account_name"];
                }
            }
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">

                <h1>Edit Bank Account</h1>

                <form method="post" action="rider_update_bank_account.php">
                    <table class="rider_profile">
                        <tr>
                            <td><label for="accountID">Account ID:</label></td>
                            <td><input type="text" readonly class='rider_input' id="accountID" name="accountID" value="<?php echo $accountID;?>"></td>
                        </tr>
                        <tr>
                            <td><label for="riderID">Rider ID:</label></td>
                            <td><input type="text" readonly class='rider_input' id="riderID" name="riderID" value="<?php echo $riderID;?>"></td>
                        </tr>
                        <tr>
                            <td><label for="accountNumber">Account Number:</label></td>
                            <td><input type="text" class='rider_input' id="accountNumber" name="accountNumber" value="<?php echo $accountNumber ?>" required></td>
                        </tr>
                        <tr>
                            <td><label for="accountName">Account Name: </label></td>
                            <td><input type="text" class='rider_input' id="accountName" name="accountName" value="<?php echo $accountName ?>" required></td>
                        </tr>
                        
                    </table>
                    <div class="div1">
                        <input type="submit" class="button1" value="Update"></input>
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