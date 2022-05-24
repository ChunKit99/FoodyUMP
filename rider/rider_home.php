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
                <a href="rider_home.php" class="" style="background: #11767ca6;">Home</a>
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
            $userID = "2";
            $riderID = "2";

            $riderProfile = "SELECT * FROM `user` WHERE `user_id` = '$userID'";
            $result = mysqli_query($conn, $riderProfile);

            $riderBankAccount = "SELECT * FROM `bankaccount` WHERE `rider_id` = '$riderID'";
            $resultBankAccount = mysqli_query($conn, $riderBankAccount);
        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <!--title-->
                <div>
                    <h1>Rider Profile</h1>
                </div>
                <!--order list with summary-->
                <form>
                    <table class="rider_profile">
                        <?php
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
                        ?>

                                    <tr>
                                        <th>User ID:</th>
                                        <td><input type="text" value="<?php echo $userID; ?>" readonly class='rider_input'></td>
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
                        <?php
                                }
                            }
                        ?>
                        
                    </table>
                    <hr>
                    
                </form>
                <div>
                    <table class="rider_profile">
                        <tr>
                            <a href="rider_add_bank_account.php"><button type="button" class="fr button1">Add</button></a>
                        </tr>
                        <tr>
                            <th scope="col">Account ID</th>
                            <th scope="col">Account Number</th>
                            <th scope="col">Account Name</th>
                            <th scope="col">Action</th>
                        </tr>
                        <tbody>
                            <?php
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