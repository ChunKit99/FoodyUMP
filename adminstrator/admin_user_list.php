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
    <link rel="stylesheet" href="/FoodyUMP/adminstrator/admin_user_list.css">
    <script src="/FoodyUMP/assets/js/admin.js"></script>
    <title>User List Foody UMP</title>
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

        <?php

        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/FoodyUMP/dbase.php";
        include_once($path);

        $query = "SELECT * FROM `user`" ;
        $result = mysqli_query($conn, $query);

        ?>

            <!--content-->
            <div id="page-content">
                <div class="page-main-content">

                    <a href="admin_add_user.php"><button type="button" class="fr button1">Add</button></a>
                    <h1 class="h1">User List </h1>

                    <form >
                        <table>
                            <tr class="tr1">
                                <th class="text1">User ID</th>
                                <th class="text1">Name</th>
                                <th class="text1">Email</th>
                                <th class="text1">Phone No.</th>
                                <th class="text1">Gender</th>
                                <th class="text1">User Type</th>
                                <th class="text1">Select</th>
                            </tr>

                            <?php
                    if (mysqli_num_rows($result) > 0) {
            // output data
            while ($row = mysqli_fetch_assoc($result)) {
                $userID = $row["user_id"];
                $name = $row["name"];
                $userType = $row["user_type"];
                $userEmail = $row["email"];
                $contactNum = $row["contact_num"];
                $gender = $row["gender"];
                ?>

                                <tr class="tr2">
                                    <td>
                                        <?php echo $userID; ?>
                                    </td>
                                    <td>
                                        <?php echo $name; ?>
                                    </td>
                                    <td>
                                        <?php echo $userEmail; ?>
                                    </td>
                                    <td>
                                        <?php echo $contactNum; ?>
                                    </td>
                                    <td>
                                        <?php echo $gender; ?>
                                    </td>
                                    <td>
                                        <?php echo $userType; ?>
                                    </td>

                                    <td>
                                        <?php echo "<a href='admin_edit_user.php?user_id=" . $userID . "'><button type='button' class='btn btn-primary'>Edit</button></a>"?>
                                        <?php echo "<a href='admin_delete_user.php?user_id=" . $userID . "'><button type='button' class='btn btn-primary'>Delete</button></a>"?>                        
                                        <?php echo "<a href='admin_view_list.php?user_id=" . $userID . "'><button type='button' class='btn btn-primary'>View</button></a>"?>    
                                    </td>

                                </tr>
                                <?php
                
                }
            }
         ?>
                        </table>



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