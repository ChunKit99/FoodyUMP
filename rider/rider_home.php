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
        <title>Rider Homepage</title>
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
                <a href="rider_home.php" class="" style="background: #11767ca6;">Home</a>
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

            $q = "SELECT * FROM `rider` WHERE `rider_id` = '$userID'";
            $res = mysqli_query($conn, $q);
            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_array($res)) {
                    $riderID = $row['rider_id'];
                    
                }
            } 
             //$_SESSION["rider_id"]= $riderID;

        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <!--title-->
                <div>
                    <h1>Rider Profile</h1>
                </div>
                <!--order list with summary-->
                <form method="post" action="rider_update_plate_no.php?rider_id=<?php echo $userID ?>">
                    <table class="rider_profile">
                        <?php
                            $riderProfile = "SELECT * FROM `user` JOIN `rider` ON user.user_id=rider.rider_id WHERE `user_id` = '$userID'";
                            $result = mysqli_query($conn, $riderProfile);
                            if (mysqli_num_rows($result) > 0) {
                                // output data
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $userID = $row["user_id"];
                                    $name = $row["name"];
                                    $userType = $row["user_type"];
                                    $username = $row["username"];
                                    $password = $row["password"];
                                    $email = $row["email"];
                                    $contactNum = $row["contact_num"];
                                    $state = $row["state"];
                                    $district = $row["district"];
                                    $postalCode = $row["postal_code"];
                                    $detailsAdd = $row["details_add"];
                                    $gender = $row["gender"];
                                    $plateNo = $row["plate_no"];
                        ?>

                                    <tr>
                                        <th>User ID:</th>
                                        <td><input type="text" name="user_id" value="<?php echo $userID; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Rider Name:</th>
                                        <td><input type="text" value="<?php echo $name; ?>" readonly class='rider_input'></td>
                                    <tr>
                                        <th>Email:</th>
                                        <td><input type="text" value="<?php echo $email; ?>" readonly class='rider_input'></td>
                                    <tr>
                                        <th>Contact Number:</th>
                                        <td><input type="text" value="<?php echo $contactNum; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>State:</th>
                                        <td><input type="text" value="<?php echo $state; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>District:</th>
                                        <td><input type="text" value="<?php echo $district; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Postal Code:</th>
                                        <td><input type="text" value="<?php echo $postalCode; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <td><input type="text" value="<?php echo $detailsAdd; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Gender:</th>
                                        <td><input type="text" value="<?php echo $gender; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>User Type: </th>
                                        <td><input type="text" value="<?php echo $userType; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Username:</th>
                                        <td><input type="text" value="<?php echo $username; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Password:</th>
                                        <td><input type="text" value="<?php echo $password; ?>" readonly class='rider_input'></td>
                                    </tr>
                                    <tr>
                                        <th>Plate No.:</th>
                                        <td><input type="text" name="plate_no" value="<?php echo $plateNo; ?>" class='rider_input'></td>
                                    </tr>
                        <?php
                                }
                            }
                        ?>
                        
                    </table>
                    <div class="div1">
                        <input type="submit" class="button1" value="Update"></input>
                        <a href="rider_home.php"><button type="button" class="button1">Cancel</button></a>
                    </div>
                    <hr>
                </form>
                <div>
                    <div>
                        <h1>Bank Account
                        <a href="rider_add_bank_account.php"><button type="button" class="fr button1">Add</button></a>
                        </h1>
                    </div>
                    <table class="rider_profile">
                        <tr>
                            <th scope="col">Account ID</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        <tbody>
                            <?php
                                $riderBankAccount = "SELECT * FROM `bankaccount` WHERE `rider_id` = '$riderID'";
                                $resultBankAccount = mysqli_query($conn, $riderBankAccount);
                                $count = 0;
                                if (mysqli_num_rows($resultBankAccount) > 0) {
                                    // output data of each row
                                    while ($row = mysqli_fetch_assoc($resultBankAccount)) {
                                        $count++;
                                        $accountID = $row["account_id"];
                                        $riderID = $row["rider_id"];
                                        $accountNumber = $row["account_number"];
                                        $accountName = $row["account_name"];
                                        echo "<tr>";
                                        echo "<th scope='row'>$accountID</th>";
                                        echo "<td>$accountNumber</td>";
                                        echo "<td>$accountName</td>";
                                        echo "<td>";
                                        echo "<div class='btn-group' role='group'>";
                                        echo "<a href='rider_edit_bank_account.php?account_id=" . $accountID . "'><button type='button'>Edit</button></a>";
                            ?>
                                        <?php
                                            echo "<a href='rider_delete_bank_account.php?account_id=" . $accountID . "'>";
                                            echo "<button type='button'>Delete</button></a>";
                                        ?>

                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
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
  
  </div>

  
</html>