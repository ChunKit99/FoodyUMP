<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/adminstrator/admin_report.css">
        <script src="/assets/js/admin.js"></script>
        <title>Administrator Report Foody UMP</title>
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

            $sqlname="SELECT `user_type`, `state` FROM `user`; ";
            $resultstatus = mysqli_query($conn, $sqlname);
            if (mysqli_num_rows($resultstatus) > 0) {
                while ($row = mysqli_fetch_array($resultstatus)) {
                    $userType = $row['user_type'];
                    $state = $row['state'];
                }
            } else {
                $userType = "Undefine user type, an error on database";
            }

            $querystatus = "SELECT SUM(CASE WHEN `state`='Johor' THEN 1 ELSE 0 END) AS jh, SUM(CASE WHEN `state`='Kedah' THEN 1 ELSE 0 END) AS kd, SUM(CASE WHEN `state`='Kelantan' THEN 1 ELSE 0 END) AS kt, SUM(CASE WHEN `state`='Melaka' THEN 1 ELSE 0 END) AS mk, SUM(CASE WHEN `state`='Negeri Sembilan' THEN 1 ELSE 0 END) AS ns, SUM(CASE WHEN `state`='Pahang' THEN 1 ELSE 0 END) AS ph, SUM(CASE WHEN `state`='Pulau Pinang' THEN 1 ELSE 0 END) AS pp, SUM(CASE WHEN `state`='Perak' THEN 1 ELSE 0 END) AS pr, SUM(CASE WHEN `state`='Perlis' THEN 1 ELSE 0 END) AS pl, SUM(CASE WHEN `state`='Sabah' THEN 1 ELSE 0 END) AS sb, SUM(CASE WHEN `state`='Sarawak' THEN 1 ELSE 0 END) AS sr, SUM(CASE WHEN `state`='Selangor' THEN 1 ELSE 0 END) AS sl, SUM(CASE WHEN `state`='Terengganu' THEN 1 ELSE 0 END) AS tr, SUM(CASE WHEN `state`='Kuala Lumpur' THEN 1 ELSE 0 END) AS kl, SUM(CASE WHEN `state`='Labuan' THEN 1 ELSE 0 END) AS lb,SUM(CASE WHEN `state`='Putrajaya' THEN 1 ELSE 0 END) AS pj FROM user ";
            $resultstatus = mysqli_query($conn, $querystatus);

            $rows =  mysqli_fetch_assoc($resultstatus);
            $totals = 0;

            ?>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">

                <table border="1">
                    
                    <tr class="tr1">
                        <th class="text3">State</th>
                        <th class="text3">Total User</th>
                    </tr>

                    <tr class="tr2">
                        <td>Johor</td>
                        <td>
                        <?php
                            $temp = $rows['jh'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>
                    </tr>


                    <tr class="tr2">
                        <td >Kedah</td>             
                        <td>
                        <?php
                            $temp = $rows['kd'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>                       
                    </tr>

                    <tr class="tr2">
                        <td>Kelantan</td>
                        <td>
                        <?php
                            $temp = $rows['kt'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td>                        
                    </tr>

                    <tr class="tr2">
                        <td >Melaka</td>
                        <td>
                        <?php
                            $temp = $rows['mk'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>


                    <tr class="tr2">
                        <td >Negeri Sembilan</td>
                        <td>
                        <?php
                            $temp = $rows['ns'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Pahang</td>
                        <td>
                        <?php
                            $temp = $rows['ph'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td >Pulau Pinang</td>
                        <td>
                        <?php
                            $temp = $rows['pp'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Perak</td>
                        <td>
                        <?php
                            $temp = $rows['pr'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Perlis</td>
                        <td>
                        <?php
                            $temp = $rows['pl'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Sabah</td>
                        <td>
                        <?php
                            $temp = $rows['sb'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Sarawak</td>
                        <td>
                        <?php
                            $temp = $rows['sr'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Selangor</td>
                        <td>
                        <?php
                            $temp = $rows['sl'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Terengganu</td>
                        <td>
                        <?php
                            $temp = $rows['tr'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Kuala Lumpur</td>
                        <td>
                        <?php
                            $temp = $rows['kl'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Labuan</td>
                        <td>
                        <?php
                            $temp = $rows['lb'];
                            ($temp <= 0) ? $temp = 0 : $temp;
                            $totals = $totals + $temp;
                            echo "$temp";
                            ?>
                        </td> 
                    </tr>

                    <tr class="tr2">
                        <td>Putrajaya</td>
                        <td>
                        <?php
                            $temp = $rows['pj'];
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
