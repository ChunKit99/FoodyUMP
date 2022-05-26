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
        <title>Rider Homepage</title>
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
                <a href="rider_home.php" class="">Home</a>
                <a href="rider_order.html">Order</a>
                <a href="rider_report.html" class="">Report</a>
                <a href="rider_complaint.php" class="">Complaint</a>
            </div>
        </div>

        <!--to include the dbase.php-->
        <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/dbase.php";
            include_once($path);
            $riderID = "2";

            //find rider base on rider id
            $query = "SELECT `rider_id` FROM `rider` WHERE `rider_id` = '$riderID' ";
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