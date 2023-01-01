<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="generaluser")
    header("location:/logout.php");
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/global.css">
    <link rel="stylesheet" href="/FoodyUMP/assets/css/general.css">
    <script src="/FoodyUMP/assets/js/admin.js"></script>
    <title>Foody UMP</title>
</head>

<!--body-->

<body>

    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/FoodyUMP/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/FoodyUMP/dbase.php";
                    include_once($path);
                    echo $_SESSION['username'] ?></h3>
                <a href="/FoodyUMP/logout.php"><button class="logout">Logout</button></a>
            </div>
        </div>
    </div>

    <div id="nav-container">
        <div class="container-width nav-container">
            <a href="user_home.php" class="">Home</a>
            <a href="user_order.php" class="">Order</a>
            <a href="user_delivery.php" class="">Delivery</a>
            <a href="user_expenses.php" class="" style="background: #11767ca6;">Expenses</a>
            <a href="user_report.php" class="">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--Woeichi-->
            <?php
            //get current week start and end
            $monday = strtotime('last monday', strtotime('tomorrow'));
            $tuesday = strtotime('+1 days', $monday);
            $sunday = strtotime('+6 days', $monday);
            $monday = date('Y-m-d', $monday);
            $tuesday = date('Y-m-d', $tuesday);
            $sunday = date('Y-m-d', $sunday);
            //echo $monday;
            //echo $tuesday;
            //echo $sunday;
 
            //get current month start and end
            $df = new DateTime('first day of this month');
            $df = $df->format('Y-m-d');
            //echo $df;
             $dl = new DateTime('last day of this month');
            $dl = $dl->format('Y-m-d');
            //echo $dl;

            echo "<div class='exp'>";
            echo "<br><br><br>";
            echo "<h1>Expenses</h1>";
            echo "</div><br><br>";
            echo "<div class='expenses'>";
            echo "<table>";
            echo "<tr>";
            echo "<th>Daily Expenses (RM):</th>";

            $userid = $_SESSION['user_id'];
            $daily = 0 ;
            $today = date("Y-m-d");
            $query = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$today' and '$today') AND (orderlist.user_id = '$userid')";

            $resultTest1 = mysqli_query($conn,$query);
            if (mysqli_num_rows($resultTest1) > 0) {
                while ($row = mysqli_fetch_array($resultTest1)) {
                    $price=$row["price"];
                    $daily=$price+$daily;
                    $daily=number_format($daily,2);
                }  
            }

            echo "<td>$daily</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Weekly Expenses (RM):</th>";

            $week = 0 ;
            $queryweek = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$monday' and '$sunday' ) AND (orderlist.user_id = '$userid')";
            $resultTest2 = mysqli_query($conn,$queryweek);
            if (mysqli_num_rows($resultTest2) > 0) {
            while ($row = mysqli_fetch_array($resultTest2)) {
                $price=$row["price"];
                $week=$price+$week;
                $week=number_format($week,2);
                }  
            }

            echo "<td>$week</td>";
            echo "</tr><tr>";
            echo "<th>Monthly Expenses (RM):</th>";

            $month = 0 ;
            $querymonth = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$df' and '$dl') AND (orderlist.user_id = '$userid')";
            $resultTest3 = mysqli_query($conn,$querymonth);
            if (mysqli_num_rows($resultTest3) > 0) {
            while ($row = mysqli_fetch_array($resultTest3)) {
                $price=$row["price"];
                $month=$price+$month;
                $month=number_format($month,2);
                }  
            }

            echo "<td>$month</td>";
            echo "</tr><tr>";
            echo "<th>Average Expenses (RM)</th>";
            echo "<td></td>";
            echo "</tr><tr>";
            echo "<th>In Week:</th>";

            $aweek = 0 ;
            $avgweek = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$monday' and '$sunday') AND (orderlist.user_id = '$userid')";
            $resultTest4 = mysqli_query($conn,$avgweek);
            if (mysqli_num_rows($resultTest4) > 0) {
            while ($row = mysqli_fetch_array($resultTest4)) {
                $price=$row["price"];
                $aweek=$week/7;
                $aweek=number_format($aweek,2);
                }  
            }

            echo "<td>$aweek</td>";
            echo "</tr><tr>";
            echo "<th>In Month:</th>";

            $amonth = 0 ;
            $avgmonth = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$monday' and '$sunday') AND (orderlist.user_id = '$userid')";
            $resultTest5= mysqli_query($conn,$avgmonth);
            if (mysqli_num_rows($resultTest5) > 0) {
            while ($row = mysqli_fetch_array($resultTest5)) {
                $price=$row["price"];
                $amonth=$month/4;
                $amonth=number_format($amonth,2);
                }  
            }

            echo "<td>$amonth</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
        ?>
            <!--Woeichi-->

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