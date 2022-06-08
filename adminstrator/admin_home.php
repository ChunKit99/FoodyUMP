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
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/adminstrator/admin_home.css">
        <script src="/assets/js/admin.js"></script>
        <title>Foody UMP</title>
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
                <a href="admin_home.php" class="">Home</a>
                <a href="admin_user_list.php" class="">User List</a>
                <a href="admin_report.php" class="">Report</a>
            </div>
        </div>

        
    <?php
            $path = $_SERVER['DOCUMENT_ROOT'];
            $path .= "/dbase.php";
            include_once($path);

            $sqlname="SELECT `user_type` FROM `user` ";
            $resultstatus = mysqli_query($conn, $sqlname);
            if (mysqli_num_rows($resultstatus) > 0) {
                while ($row = mysqli_fetch_array($resultstatus)) {
                    $userType = $row['user_type'];
                }
            } else {
                $userType = "Undefine user type, an error on database";
            }

            $querystatus = "SELECT SUM(CASE WHEN user_type = 'Administrator' THEN 1 ELSE 0 END) AS ad, SUM(CASE WHEN user_type = 'Restaurant' THEN 1 ELSE 0 END) AS ro, SUM(CASE WHEN user_type = 'GeneralUser' THEN 1 ELSE 0 END) AS gu, SUM(CASE WHEN user_type = 'Rider' THEN 1 ELSE 0 END) AS rd FROM user ";
            $resultstatus = mysqli_query($conn, $querystatus);

            $rows =  mysqli_fetch_assoc($resultstatus);
            $totals = 0;

            ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <table>
                    
                    <tr class="tr1">
                        <th class="text2">User Type</th>
                        <th class="text2">Total For Each User Type</th>
                    </tr>

                    <tr class="tr2">
                        <td>Administrator</td>
                        <td>
                        <?php
                            $temp = $rows['ad'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>
                    </tr>

                    <tr class="tr2">
                        <td>Restaurant Owner</td>
                        <td>
                            <?php
                            $temp = $rows['ro'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>
                    </tr>

                    <tr class="tr2">
                        <td>General User</td>
                        <td>
                        <?php
                            $temp = $rows['gu'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>
                    </tr>

                    <tr class="tr2">
                        <td>Rider</td>
                        <td>
                            <?php
                            $temp = $rows['rd'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                            </td>
                    </tr>
                </table>    
                <br>


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
