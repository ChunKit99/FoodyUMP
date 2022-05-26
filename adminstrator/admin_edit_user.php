<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="admin_add_user.css">
    <script src="/assets/js/admin.js"></script>
    <title>Edit User Foody UMP</title>
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

                <h1 class="h2">Edit User Profile</h1>

                <form method="post" action="admin_update_user.php?user_id=<?php echo $userID ?>">
                    <table>

                        <tr>
                            <td><label for="userID">User ID: </label></td>
                            <td><?php echo "<input type='text' readonly class='form-control-plaintext' id='UserID' value='$userID' >" ?></td>
                        </tr>


                        <tr>
                            <td><label for="name">Name: </label></td>
                            <td><input type="text" id="name" name="name" value="<?php echo $name; ?>" required></td>
                        </tr>

                        <tr>
                            <td><label for="userEmail">Email:</label></td>
                            <td><input type="text" id="userEmail" name="userEmail" value=<?php echo $userEmail; ?> required></td>

                        </tr>

                        <tr>
                            <td><label for="contactNum">Phone Number:</label></td>
                            <td><input type="text" id="contactNum" name="contactNum" value=<?php echo $contactNum; ?> required></td>
                        </tr>

                        <tr>
                            <td><label for="state">State:</label></td>
                            <td>
                                <select name="state" >
                                <?php
                                    $selectstates = array('Johor','Kedah','Kelantan','Melaka', 'Negeri Sembilan', 'Pulau Pinang', 'Perak', 'Perlis', 'Sabah', 'Sarawak', 'Selangor', 'Terengganu', 'Kuala Lumpur', 'Labuan', 'Putrajaya');

                                        foreach ($selectstates as $selectstate) {
                                            if ($state == $selectstate) {
                                                echo "<option selected value='$selectstate'>$selectstate</option>";
                                            } else {
                                                echo "<option value='$selectstate'>$selectstate</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="district">District:</label></td>
                            <td><input type="text" id="district" name="district" value=<?php echo $district; ?> required></td>
                        </tr>

                        <tr>
                            <td><label for="postalCode">Postal Code:</label></td>
                            <td><input type="text" id="postalCode" name="postalCode" value=<?php echo $postalCode; ?> required></td>
                        </tr>

                        <tr>
                            <td><label for="detailsAdd">Details Address:</label></td>
                            <td><input type="text" id="detailsAdd" name="detailsAdd" value=<?php echo $detailsAdd; ?> required></td>
                        </tr>

                        <tr>
                            <td><label for="userName">Username:</label></td>
                            <td><input type="text" id="userName" name="userName" value="<?php echo $userName ?>" required></td>
                        </tr>

                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="text" id="password" name="password" value=<?php echo $password; ?> required></td>
                        </tr>


                        <tr>
                            <td><label for="userType">User Type:</label></td>
                            <td>
                                <select name="userType" >
                                <?php
                                    $selectuserTypes = array('Administrator','Rider','General User','Restaurant Owner');

                                        foreach ($selectuserTypes as $selectuserType) {
                                            if ($userType == $selectuserType) {
                                                echo "<option selected value='$selectuserType'>$selectuserType</option>";
                                            } else {
                                                echo "<option value='$selectuserType'>$selectuserType</option>";
                                            }
                                        }
                                        ?>
                                </select>
                            </td>        
                            
                        </tr>

                        <tr>
                            <td><label for="gender">Gender:</label></td>
                            <td>
                                <!--<input type="radio" value="Male" name="gender" />Male
                                <input type="radio" value="Female" name="gender" />Female-->  
                                <select name="gender" id="gender">
                                <?php
                                    $selectGenders = array('Male','Female');

                                        foreach ($selectGenders as $selectGender) {
                                            if ($gender == $selectGender) {
                                                echo "<option selected value='$selectGender'>$selectGender</option>";
                                            } else {
                                                echo "<option value='$selectGender'>$selectGender</option>";
                                            }
                                        }
                                        ?> 
                                </select>
                            </td>
                        </tr>
                    </table>

                    <div class="div1 ">
                        <input type="submit" class="button2" value="Edit"></input>
                        <a href="admin_user_list.php"><button type="button" class="button2">Cancel</button></a>
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