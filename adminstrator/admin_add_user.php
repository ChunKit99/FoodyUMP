<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="administrator")
    header("location:/logout.php");
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/global.css">
    <link rel="stylesheet" href="admin_add_user.css">
    <script src="/FoodyUMP/assets/js/admin.js"></script>
    <title>Add User Foody UMP</title>
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
            <a href="admin_home.php" class="">Home</a>
            <a href="admin_user_list.php" class="">User List</a>
            <a href="admin_report.php" class="">Report</a>
        </div>
    </div>

    <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/FoodyUMP/dbase.php";
            include_once($path);
            ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">

                <h1 class="h2">Add User</h1>

                <form method="post" action="admin_insert_user.php">
                    <table>

                        <tr>
                            <td><label for="name">Name: </label></td>
                            <td><input type="text" id="name" name="name" required></td>
                        </tr>

                        <tr>
                            <td><label for="userEmail">Email:</label></td>
                            <td><input type="text" id="userEmail" name="userEmail" required></td>

                        </tr>

                        <tr>
                            <td><label for="contactNum">Phone Number:</label></td>
                            <td><input type="text" id="contactNum" name="contactNum" required></td>
                        </tr>

                        <tr>
                            <td><label for="state">State:</label></td>
                            <td>    
                            <select name="state" id="state">
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option> 
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Melaka">Melaka</option>   
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>  
                                    <option value="Pulau Pinang">Pulau Pinang</option>  
                                    <option value="Perak">Perak</option>  
                                    <option value="Perlis">Perlis</option>  
                                    <option value="Sabah">Sabah</option>  
                                    <option value="Sarawak">Sarawak</option>  
                                    <option value="Selangor	">Selangor</option>  
                                    <option value="Terengganu">Terengganu</option>  
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>  
                                    <option value="Labuan">Labuan</option>  
                                    <option value="Putrajaya">Putrajaya</option>  
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for="district">District:</label></td>
                            <td><input type="text" id="district" name="district" required></td>
                        </tr>

                        <tr>
                            <td><label for="postalCode">Postal Code:</label></td>
                            <td><input type="text" id="postalCode" name="postalCode" required></td>
                        </tr>

                        <tr>
                            <td><label for="detailsAdd">Details Address:</label></td>
                            <td><input type="text" id="detailsAdd" name="detailsAdd" required></td>
                        </tr>

                        <tr>
                            <td><label for="userName">Username:</label></td>
                            <td><input type="text" id="userName" name="userName" required></td>
                        </tr>

                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td><input type="text" id="password" name="password" required></td>
                        </tr>


                        <tr>
                            <td><label for="userType">User Type:</label></td>
                            <td>
                                <select name="userType" id="userType">
                                    <option value="administrator">Administrator</option>
                                    <option value="restaurant">Restaurant Owner</option> 
                                    <option value="generaluser">General User</option>
                                    <option value="rider">Rider</option>
                            </td>
                            </select>
                        </tr>

                        <tr>
                            <td><label for="gender">Gender:</label></td>
                            <td>
                            <select name="gender" id="gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option> 
                            </td>
                            </select>
                            </td>
                        </tr>
                    </table>

                    <div class="div1 ">
                        <input type="submit" class="button2" value="Add"></input>
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