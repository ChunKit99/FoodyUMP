<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/general.css">
    <script src="/assets/js/admin.js"></script>
    <title>Foody UMP</title>
</head>

<!--body-->

<body>
<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="generaluser")
    header("location:/logout.php");
?>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/dbase.php";
                    include_once($path);
                    echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
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
     $sunday = strtotime('+6 days', $monday);
     $monday = date('Y-m-d', $monday);
     $sunday = date('Y-m-d', $sunday);
     //echo $monday;
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
            echo "<th>Daily Expenses: </th>";
            echo "<td></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<th>Weekly Expenses:</th>";
            echo "<td></td>";
            echo "</tr><tr>";
            echo "<th>Monthly Expenses:</th>";
            echo "<td></td>";
            echo "</tr><tr>";
            echo "<th>Average Expenses</th>";
            echo "<td></td>";
            echo "</tr><tr>";
            echo "<th>In Week:</th>";
            echo "<td></td>";
            echo "</tr><tr>";
            echo "<th>In Month:</th>";
            echo "<td></td>";
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