<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="admin_add_user.css">
    <script src="/assets/js/admin.js"></script>
    <title>View User Foody UMP</title>
</head>

<!--body-->

<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
    if($_SESSION["user_type"]!="administrator")
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
            <a href="admin_home.php" class="">Home</a>
            <a href="admin_user_list.php" class="">User List</a>
            <a href="admin_report.php" class="">Report</a>
        </div>
    </div>

    <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/dbase.php";
            include_once($path);            
            
            $userID=$_GET['user_id'];
    
            $query = "SELECT * FROM `user` WHERE `user_id` = '$userID' ";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                // output data
                while ($row = mysqli_fetch_assoc($result)) {
                    $userID = $row["user_id"];
                    $name = $row["name"];
                    $userEmail = $row["email"];
                    $contactNum = $row["contact_num"];
                    $state = $row["state"];
                    $district = $row["district"];
                    $postalCode = $row["postal_code"];
                    $detailsAdd = $row["details_add"];
                    $userName = $row["username"];
                    $password = $row["password"];
                    $userType = $row["user_type"];
                    $gender = $row["gender"];

                }
            }  

        ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">

                <h1 class="h2">View User Profile</h1>

                <form method="post" action="admin_update_user.php?user_id=<?php echo $userID ?>">
                    <table>

                        <tr>
                            <td><label for="userID">User ID: </label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='UserID' value='$userID' >" ?></td>
                        </tr>


                        <tr>
                            <td><label for="name">Name: </label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='name' value='$name' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="userEmail">Email:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='userMail' value='$userEmail' >" ?></td>

                        </tr>

                        <tr>
                            <td><label for="contactNum">Phone Number:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='contactNum' value='$contactNum' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="state">State:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='state' value='$state' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="district">District:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='district' value='$district' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="postalCode">Postal Code:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='postalCode' value='$postalCode' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="detailsAdd">Details Address:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='detailsAdd' value='$detailsAdd' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="userName">Username:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='userName' value='$userName' >" ?></td>
                        </tr>

                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='password' value='$password' >" ?></td>
                        </tr>


                        <tr>
                            <td><label for="userType">User Type:</label></td>
                            <td>
                                <?php echo "<input type='select' readonly class='form-control-plaintext' id='userType' value='$userType' >" ?>      
                            </td>                              
                        </tr>

                        <tr>
                            <td><label for="gender">Gender:</label></td>
                            <td>
                            <?php echo "<input type='select' readonly class='form-control-plaintext' id='gender' value='$gender' >" ?>
                            </td>
                        </tr>
                    </table>

                    <div class="div1 ">
                        <a href="admin_user_list.php"><button type="button" class="button2">Back</button></a>
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