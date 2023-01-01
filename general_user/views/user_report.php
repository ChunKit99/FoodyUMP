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
            <a href="user_expenses.php" class="">Expenses</a>
            <a href="user_report.php" class="" style="background: #11767ca6;">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--woeichi-->
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

            $week = 0 ;
            $userid = $_SESSION['user_id'];
            $queryweek = "SELECT * FROM `orderlist` WHERE (orderlist.order_date between '$monday' and '$sunday' ) AND (orderlist.user_id = '$userid')";
            $resultTest2 = mysqli_query($conn,$queryweek);
            if (mysqli_num_rows($resultTest2) > 0) {
            while ($row = mysqli_fetch_array($resultTest2)) {
                $price=$row["price"];
                $week=$price+$week;
                $week=number_format($week,2);
                }  
            }
            ?>

            <div id="piechart"></div>

                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Total Expenses', 'price'],
                            ['Total Expenses', '<?php echo "$week"?>'],
                        ]);

                        // Optional; add a title and set the width and height of the chart
                        var options = { 'title': 'Total Weekly Expenses', 'width': 1500, 'height': 600 };
                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                        chart.draw(data, options);
                    }
                </script>

            <!--woeichi-->
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