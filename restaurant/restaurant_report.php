<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/restaurant.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/complaint.css">

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
    $currentStartDate = strtotime('last monday', strtotime('tomorrow'));
    $currentEndDate = strtotime('+6 days', $currentStartDate);
    $cmonday = date('Y-m-d', $currentStartDate);
    $csunday = date('Y-m-d', $currentEndDate);
    //echo $cmonday;
    //echo $csunday;

    //get last week start and end
    $lastStartDate = strtotime('last sunday', strtotime('tomorrow'));
    $lastEndDate = strtotime('-6 days', $lastStartDate);
    $lmonday = date('Y-m-d', $lastStartDate);
    $lsunday = date('Y-m-d', $lastEndDate);
    //echo $lmonday;
    //echo $lsunday;

    //get current month start and end
    $df = new DateTime('first day of this month');
    $df = $df->format('Y-m-d');
    //echo $df;
    $dl = new DateTime('last day of this month');
    $dl = $dl->format('Y-m-d');
    //echo $dl;

    //get current year start and end
    $yf = Date('Y-m-d', strtotime('this year January 1st'));
    //echo $yf;
    $yl = Date('Y-m-d', strtotime('this year December 31st'));
    //echo $yl;
 
 
     $query = "SELECT * FROM orderlist WHERE restaurant_id = '$restaurantid' ORDER BY `order_id` ASC;";
     $resultList = mysqli_query($conn, $query);

     
    $querycurrentweek = "SELECT SUM(price) AS cw FROM orderlist WHERE (order_date between '$cmonday' and '$csunday') AND (restaurant_id = '$restaurantid')";
    $querylastweek = "SELECT SUM(price) AS lw FROM orderlist WHERE (order_date between '$lsunday' and '$lmonday') AND (restaurant_id = '$restaurantid')";
    $querymonth = "SELECT SUM(price) AS m FROM orderlist WHERE (order_date between '$df' and '$dl') AND (restaurant_id = '$restaurantid') ";
    $queryyear = "SELECT SUM(price) AS y FROM orderlist WHERE (order_date between '$yf' and '$yl') AND (restaurant_id = '$restaurantid')";
    

    $resultcurrentweek = mysqli_query($conn, $querycurrentweek);
    $resultlastweek = mysqli_query($conn, $querylastweek);
    $resultmonth = mysqli_query($conn, $querymonth);
    $resultyear = mysqli_query($conn, $queryyear);

    $rowcw = mysqli_fetch_assoc($resultcurrentweek);
    $rowlw = mysqli_fetch_assoc($resultlastweek);
    $rowm = mysqli_fetch_assoc($resultmonth);
    $rowy = mysqli_fetch_assoc($resultyear);

    ?>
        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Report</h1>
                    <div class='row'>
                        <div class='column'>
                    <table class="calculateReport">
                        <tr>
                            <th colspan="2">Current Week(<?php echo "$cmonday until $csunday" ?>)</th>
                        </tr>
                        
                        <tr>
                            <th>Total order receive:</th>
                            <?php 
                                $test = "SELECT * FROM orderlist WHERE (order_date between '$cmonday' and '$csunday') AND (restaurant_id = '$restaurantid')";
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
                                $test1 = "SELECT sum(price) FROM `orderlist` WHERE (order_date between '$cmonday' and '$csunday') AND (restaurant_id = '$restaurantid')";
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
                                $test2 = "SELECT price FROM `orderlist` WHERE (order_date between '$cmonday' and '$csunday') AND (restaurant_id = '$restaurantid')";
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
                                $test3 = "SELECT price FROM `orderlist` WHERE (order_date between '$cmonday' and '$csunday') AND (restaurant_id = '$restaurantid')";
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
                            <th colspan="2">Last Week(<?php echo "$lsunday until $lmonday" ?>)</th>
                        </tr>
                        
                        <tr>
                            <th>Total order receive:</th>
                            <?php 
                                $test = "SELECT * FROM orderlist WHERE (order_date between '$lsunday' and '$lmonday') AND (restaurant_id = '$restaurantid')";
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
                                $test1 = "SELECT sum(price) FROM `orderlist` WHERE (order_date between '$lsunday' and '$lmonday') AND (restaurant_id = '$restaurantid')";
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
                                $test2 = "SELECT price FROM `orderlist` WHERE (order_date between '$lsunday' and '$lmonday') AND (restaurant_id = '$restaurantid')";
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
                                $test3 = "SELECT price FROM `orderlist` WHERE (order_date between '$lsunday' and '$lmonday') AND (restaurant_id = '$restaurantid')";
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
                                    </div>










                                    <div class='row'>
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
                    
                    <div class='column'>

                    <table class="calculateReport">
                        <tr>
                            <th colspan="2">Current Year(<?php echo "$yf until $yl" ?>)</th>
                        </tr>
                        
                        <tr>
                            <th>Total order receive:</th>
                            <?php 
                                $test = "SELECT * FROM orderlist WHERE (order_date between '$yf' and '$yl') AND (restaurant_id = '$restaurantid')";
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
                                $year1 = "SELECT sum(price) FROM `orderlist` WHERE (order_date between '$yf' and '$yl') AND (restaurant_id = '$restaurantid')";
                                $resultYear1 = mysqli_query($conn,$year1);
                                if (mysqli_num_rows($resultYear1) > 0) {
                                    while ($row = mysqli_fetch_array($resultYear1)) {
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
                            $totalRiderY=0;
                                $year2 = "SELECT price FROM `orderlist` WHERE (order_date between '$yf' and '$yl') AND (restaurant_id = '$restaurantid')";
                                $resultYear2 = mysqli_query($conn,$year2);
              
                                if (mysqli_num_rows($resultYear2) > 0) {
                                    while ($row = mysqli_fetch_array($resultYear2)) {
                                        $price=$row["price"];
                                        $riderCom=$price*4/100;
                                        $totalRiderY=$riderCom + $totalRiderY;
                                        $totalRiderY=number_format($totalRiderY,2);}}
               
                            echo "<td>";
                            echo $totalRiderY;
                            echo "</td>";
                            ?>
                        </tr>
                        <tr>
                            <th>Total commission to Foody (RM):</th>
                            <?php 
                            $totalFoodyY=0;
                                $year3 = "SELECT price FROM `orderlist` WHERE (order_date between '$yf' and '$yl') AND (restaurant_id = '$restaurantid')";
                                $resultYear3 = mysqli_query($conn,$year3);
              
                                if (mysqli_num_rows($resultYear3) > 0) {
                                    while ($row = mysqli_fetch_array($resultYear3)) {
                                        $price=$row["price"];
                                        $foodyCom=$price*5/100;
                                        $totalFoodyY=$foodyCom+$totalFoodyY;
                                        $totalFoodyY=number_format($totalFoodyY,2);}}
               
                            echo "<td>";
                            echo $totalFoodyY;
                            echo "</td>";
                            ?>
                        </tr>

                        <tr>
                            <th>Net Income (RM):</th>
                                 <?php
                                    $netIncomeY = $totalIncome - $totalRiderM - $totalFoodyM;
                                    $netIncomeY = number_format($netIncomeY,2);
                                    echo "<td>";
                                    echo $netIncomeY;
                                    echo "</td>";
                                    ?>
                        </tr>
                                
                        <tr>
                            <th>Accumulated income:</th>
                            <?php 
                                $year4 = "SELECT sum(price) FROM `orderlist` WHERE restaurant_id = '$restaurantid'";
                                $resultYear4 = mysqli_query($conn,$year4);
                                if (mysqli_num_rows($resultYear4) > 0) {
                                    while ($row = mysqli_fetch_array($resultYear4)) {
                                        $accIncomeY=$row["sum(price)"];
                                        $accIncomeY = number_format($accIncomeY,2);}}

                            echo "<td>";
                            echo $accIncomeY;
                            echo "</td>"
                            ?>
                        </tr>
                    </table>
                                    </div>
                                    </div>














                <div id="highestLowest">
                <div class="card-body">
                        <!--Graph-->
                        <script src="/assets/js/complaint_report_pie.js"></script>
                        <div class="col">
                            <br>
                        </div>
                        <div class="col">
                            <canvas id="monthly" style="width:100%;max-width:600px"></canvas>
                        </div>
                <script>
                            var yWValues = [<?php echo "$rowlw[lw]" ?>, <?php echo "$rowcw[cw]" ?>];
                            var yMValues = [<?php echo "$rowm[m]" ?>];
                            var yYValues = [<?php echo "$rowy[y]" ?>];

                            new Chart("monthly", {
                                type: "bar",
                                data: {
                                    labels: ["<?php echo "$df until $dl" ?>"],
                                    datasets: [{
                                        label: "income month",
                                        backgroundColor: "lightgreen",
                                        fill: false,
                                        tension: 1,
                                        data: yMValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Total Income Monthly (<?php echo "$df until $dl" ?>)"
                                    }
                                }
                            });

                </script>
>
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
