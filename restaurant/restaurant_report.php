<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/restaurant.css">
        <script src="/assets/js/admin.js"></script>
        <script src="/assets/js/restaurant.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>

        <title>Foody UMP</title>
    </head>

    <!--body-->
    <?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="restaurant")
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
                <a href="restaurant_profile.php" class="" >Home</a>
                <a href="restaurant_food.php" class="">Food</a>
                <a href="restaurant_order.php" class="">Order</a>
                <a href="restaurant_report.php" class="" style="background: #11767ca6;">Report</a>
            </div>
        </div>

        <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);
    $userid = $_SESSION["user_id"];
    $restaurantid= $_SESSION["restaurant_id"];
    
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
 
 
     $query = "SELECT * FROM orderlist WHERE restaurant_id = '$restaurantid' ORDER BY `order_id` ASC;";
     $resultList = mysqli_query($conn, $query);
 
     $querymonth = "SELECT SUM(price) FROM orderlist WHERE (order_date  between '$df' and '$dl') AND (restaurant_id = '$restaurantid')";


    ?>
        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Report</h1>
                    <div class='row'>
                        <div class='column'>
                    <table class="calculateReport">
                        <tr>
                            <th colspan="2">Weekly(<?php echo "$monday until $sunday" ?>)</th>
                        </tr>
                        
                        <tr>
                            <th>Total order receive:</th>
                            <?php 
                                $test = "SELECT * FROM orderlist WHERE (order_date between '$monday' and '$sunday') AND (restaurant_id = '$restaurantid')";
                                $resultTest = mysqli_query($conn,$test);
                                $num_row=mysqli_num_rows($resultTest);
               
                            echo "<td>";
                            echo "$num_row";
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total income (RM):</th>
                            <?php 
                                $test1 = "SELECT sum(price) FROM `orderlist` WHERE (order_date between '$monday' and '$sunday') AND (restaurant_id = '$restaurantid')";
                                $resultTest1 = mysqli_query($conn,$test1);
                                if (mysqli_num_rows($resultTest1) > 0) {
                                    while ($row = mysqli_fetch_array($resultTest1)) {
                                        $totalIncome=$row["sum(price)"];
                                        $totalIncome=number_format($totalIncome,2);}}
               
                            echo "<td>";
                            echo $totalIncome;
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total commission to rider (RM):</th>
                            <?php 
                            $totalRider=0;
                                $test2 = "SELECT price FROM `orderlist` WHERE (order_date between '$monday' and '$sunday') AND (restaurant_id = '$restaurantid')";
                                $resultTest2 = mysqli_query($conn,$test2);
              
                                if (mysqli_num_rows($resultTest2) > 0) {
                                    while ($row = mysqli_fetch_array($resultTest2)) {
                                        $price=$row["price"];
                                        $riderCom=$price*4/100;
                                        $totalRider=$riderCom + $totalRider;
                                        $totalRider=number_format($totalRider,2);}}
               
                            echo "<td>";
                            echo $totalRider;
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total commission to Foody (RM):</th>
                            <?php 
                            $totalFoody=0;
                                $test3 = "SELECT price FROM `orderlist` WHERE (order_date between '$monday' and '$sunday') AND (restaurant_id = '$restaurantid')";
                                $resultTest3 = mysqli_query($conn,$test3);
              
                                if (mysqli_num_rows($resultTest3) > 0) {
                                    while ($row = mysqli_fetch_array($resultTest3)) {
                                        $price=$row["price"];
                                        $foodyCom=$price*5/100;
                                        $totalFoody=$foodyCom+$totalFoody;
                                        $totalFoody=number_format($totalFoody,2);}}
               
                            echo "<td>";
                            echo $totalFoody;
                            echo "</td>";
                            ?>
                        </tr>

                        <tr>
                            <th>Net Income (RM):</th>
                                 <?php
                                    $netIncome = $totalIncome[0] - $totalRider - $totalFoody;
                                    $netIncome2 = number_format($netIncome,2);
                                    echo "<td>";
                                    echo $netIncome2;
                                    echo "</td>";
                                    ?>
                        </tr>
                                
                        <tr>
                            <th>Accumulated income:</th>
                            <?php 
                                $test4 = "SELECT sum(price) FROM `orderlist` WHERE restaurant_id = '$restaurantid'";
                                $resultTest4 = mysqli_query($conn,$test4);
                                if (mysqli_num_rows($resultTest4) > 0) {
                                    while ($row = mysqli_fetch_array($resultTest4)) {
                                        $accIncome=$row["sum(price)"];
                                        $accIncome=number_format($accIncome,2);}}
               
                            echo "<td>";
                            echo $accIncome;
                            echo "</td>";
                            ?>
                        </tr>
                    </table>
                    </div>
                    
                    <div class='column'>

                    <table class="calculateReport">
                        <tr>
                            <th colspan="2">Monthly(<?php echo "$df until $dl" ?>)</th>
                        </tr>
                        
                        <tr>
                            <th>Total order receive:</th>
                            <?php 
                                $test = "SELECT * FROM orderlist WHERE (order_date between '$df' and '$dl') AND (restaurant_id = '$restaurantid')";
                                $resultTest = mysqli_query($conn,$test);
                                $num_row=mysqli_num_rows($resultTest);
               
                            echo "<td>";
                            echo "$num_row";
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total income (RM):</th>
                            <?php 
                                $month1 = "SELECT sum(price) FROM `orderlist` WHERE (order_date between '$df' and '$dl') AND (restaurant_id = '$restaurantid')";
                                $resultMonth1 = mysqli_query($conn,$month1);
                                if (mysqli_num_rows($resultMonth1) > 0) {
                                    while ($row = mysqli_fetch_array($resultMonth1)) {
                                        $totalIncome1=$row["sum(price)"];
                                        $totalIncome1=number_format($totalIncome1,2);}}
               
                            echo "<td>";
                            echo $totalIncome1;
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total commission to rider (RM):</th>
                            <?php 
                            $totalRiderM=0;
                                $month2 = "SELECT price FROM `orderlist` WHERE (order_date between '$df' and '$dl') AND (restaurant_id = '$restaurantid')";
                                $resultMonth2 = mysqli_query($conn,$month2);
              
                                if (mysqli_num_rows($resultTest2) > 0) {
                                    while ($row = mysqli_fetch_array($resultMonth2)) {
                                        $price=$row["price"];
                                        $riderCom=$price*4/100;
                                        $totalRiderM=$riderCom + $totalRiderM;
                                        $totalRiderM=number_format($totalRiderM,2);}}
               
                            echo "<td>";
                            echo $totalRiderM;
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total commission to Foody (RM):</th>
                            <?php 
                            $totalFoodyM=0;
                                $month3 = "SELECT price FROM `orderlist` WHERE (order_date between '$df' and '$dl') AND (restaurant_id = '$restaurantid')";
                                $resultMonth3 = mysqli_query($conn,$month3);
              
                                if (mysqli_num_rows($resultTest3) > 0) {
                                    while ($row = mysqli_fetch_array($resultMonth3)) {
                                        $price=$row["price"];
                                        $foodyCom=$price*5/100;
                                        $totalFoodyM=$foodyCom+$totalFoodyM;
                                        $totalFoodyM=number_format($totalFoodyM,2);}}
               
                            echo "<td>";
                            echo $totalFoodyM;
                            echo "</td>";
                            ?>
                        </tr>

                        <tr>
                            <th>Net Income (RM):</th>
                                 <?php
                                    $netIncomeM = $totalIncome[0] - $totalRiderM - $totalFoodyM;
                                    $netIncomeM2 = number_format($netIncomeM,2);
                                    echo "<td>";
                                    echo $netIncomeM2;
                                    echo "</td>";
                                    ?>
                        </tr>
                                
                        <tr>
                            <th>Accumulated income:</th>
                            <?php 
                                $month4 = "SELECT sum(price) FROM `orderlist` WHERE restaurant_id = '$restaurantid'";
                                $resultMonth4 = mysqli_query($conn,$month4);
                                if (mysqli_num_rows($resultMonth4) > 0) {
                                    while ($row = mysqli_fetch_array($resultMonth4)) {
                                        $accIncomeM=$row["sum(price)"];
                                        $accIncomeM = number_format($accIncomeM,2);}}

                            echo "<td>";
                            echo $accIncomeM;
                            echo "</td>"
                            ?>
                        </tr>
                    </table>
                                    </div>
                                    </div>


                <div id="highestLowest">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(hLIncome);

                    function hLIncome() {
                       var data = new google.visualization.DataTable();
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Income');

                      data.addRows([
                      [new Date(2022,0,1), 42],   [new Date(2022,0,2), 10],  [new Date(2022,0,3), 23],  [new Date(2022,0,4), 17],  
                      [new Date(2022,0,5), 18],  [new Date(2022,0,6), 9],  [new Date(2022,0,7), 27],  [new Date(2022,0,8), 33],  
                      [new Date(2022,0,9), 40],  [new Date(2022,0,10), 32], [new Date(2022,0,11), 35],  [new Date(2022,0,12), 30], 
                      [new Date(2022,0,13), 40], [new Date(2022,0,14), 42], [new Date(2022,0,15), 47], [new Date(2022,0,16), 44], 
                      [new Date(2022,0,17), 48],  [new Date(2022,0,18), 52], [new Date(2022,0,19), 54], [new Date(2022,0,20), 42], 
                      [new Date(2022,0,21), 55], [new Date(2022,0,22), 56], [new Date(2022,0,23), 57],  [new Date(2022,0,24), 60], 
                      [new Date(2022,0,25), 50], [new Date(2022,0,26), 52], [new Date(2022,0,27), 51], [new Date(2022,0,28), 49], 
                      [new Date(2022,0,29), 53],  [new Date(2022,0,30), 55], [new Date(2022,0,31), 60]
                      ]);

                      var options = {
                        hAxis: {
                            format: 'dd',
                            title: 'Date'
                        },
                        vAxis: {
                            title: 'Income (Month)'
                        }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('highestLowest'));
                    chart.draw(data, options);
                }
            </script>               
                </div>

                <div id="numberOrders">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(graphOrder);

                    function graphOrder() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('date', 'Date');
                        data.addColumn('number', 'numOrder');

                        data.addRows([
                      [new Date(2022,0,1), 4],   [new Date(2022,0,2), 1],  [new Date(2022,0,3), 3],  [new Date(2022,0,4), 7],  
                      [new Date(2022,0,5), 8],  [new Date(2022,0,6), 9],  [new Date(2022,0,7), 7],  [new Date(2022,0,8), 3],  
                      [new Date(2022,0,9), 4],  [new Date(2022,0,10), 3], [new Date(2022,0,11), 5],  [new Date(2022,0,12), 3], 
                      [new Date(2022,0,13), 4], [new Date(2022,0,14), 4], [new Date(2022,0,15), 7], [new Date(2022,0,16), 4], 
                      [new Date(2022,0,17), 8],  [new Date(2022,0,18), 5], [new Date(2022,0,19), 5], [new Date(2022,0,20), 4], 
                      [new Date(2022,0,21), 5], [new Date(2022,0,22), 6], [new Date(2022,0,23), 7],  [new Date(2022,0,24), 6], 
                      [new Date(2022,0,25), 5], [new Date(2022,0,26), 2], [new Date(2022,0,27), 5], [new Date(2022,0,28), 9], 
                      [new Date(2022,0,29), 3],  [new Date(2022,0,30), 5], [new Date(2022,0,31), 6]
                      ]);

                      var options = {
                        hAxis: {
                            format: 'dd',
                            title: 'Date'
                            },
                            vAxis: {
                                title: 'Number of Orders (Month)'
                            }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('numberOrders'));
                        chart.draw(data, options);
                    }
            </script>               
                </div>

                <div id="accIncome">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(graphAccumulateIncome);

                    function graphAccumulateIncome() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('date', 'year');
                        data.addColumn('number', 'accumulateIncome');

                        data.addRows([
                        [new Date(2020,0,1), 2050],   [new Date(2021,0,1), 5045],  [new Date(2022,0,1), 5784]
                        ]);

                        var options = {
                            hAxis: {
                                format:'yyyy',
                                title: 'Year'
                            },
                            vAxis: {
                                title: 'Accumulate Income'
                            }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('accIncome'));
                        chart.draw(data, options);
                    }
            </script>               
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
</html>
