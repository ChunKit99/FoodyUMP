<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/complaint.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/rider.css">
    <script src="/assets/js/rider_qr.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/admin.js"></script>

    <title>Rider Report</title>
</head>
<!--body-->
<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if ($_SESSION["user_type"] != "rider")
    header("location:/logout.php");
?>
<body>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100">
            </div>
            <div class="topright-container fr">
            <h3><?php echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
            </div>
        </div>
    </div>
    <div id="nav-container">
        <div class="container-width nav-container">
                <a href="rider_home.php" class="">Home</a>
                <a href="rider_order.php">Order</a>
                <a href="rider_delivery_record.php" class="">Records</a>
                <a href="rider_report.php" class="" style="background: #11767ca6;">Report</a>
                <a href="rider_complaint.php" class="">Complaint</a>
        </div>
    </div>
    <!--to include the dbase.php-->
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);

    $riderid = $_SESSION["user_id"];
    
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

    $querycurrentweek = "SELECT SUM(price) AS cw FROM orderlist WHERE (order_date between '$cmonday' and '$csunday') AND (rider_id = '$riderid'); ";
    $querylastweek = "SELECT SUM(price) AS lw FROM orderlist WHERE (order_date between '$lsunday' and '$lmonday') AND (rider_id = '$riderid'); ";
    $querymonth = "SELECT SUM(price) AS m FROM orderlist WHERE (order_date between '$df' and '$dl') AND (rider_id = '$riderid'); ";
    $queryyear = "SELECT SUM(price) AS y FROM orderlist WHERE (order_date between '$yf' and '$yl') AND (rider_id = '$riderid'); ";
    
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
            <!--title-->
            <h1>Report</h1>
                <div class='row'>
                    <div class='column'>
                        <table class="calculateReport">
                            <tr>
                                <th colspan="2">Current Week (<?php echo "$cmonday until $csunday" ?>)</th>
                            </tr>
                            <tr>
                                <th>Total order receive:</th>
                                <?php 
                                    $test = "SELECT * FROM orderlist WHERE (order_date between '$cmonday' and '$csunday') AND (rider_id = '$riderid')";
                                    $resultTest = mysqli_query($conn,$test);
                                    $num_row=mysqli_num_rows($resultTest);
                
                                echo "<td>";
                                echo "$num_row";
                                echo "</td>";
                                ?>
                            </tr>
                            <tr>
                                <th>Total commission (RM):</th>
                                <?php 
                                $totalRider=0;
                                    $test2 = "SELECT price FROM `orderlist` WHERE (order_date between '$cmonday' and '$csunday') AND (rider_id = '$riderid')";
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
                        </table>
                    </div>

                    <div class='column'>
                        <table class="calculateReport">
                            <tr>
                                <th colspan="2">Last Week (<?php echo "$lsunday until $lmonday" ?>)</th>
                            </tr>
                            <tr>
                                <th>Total order receive:</th>
                                <?php 
                                    $test = "SELECT * FROM orderlist WHERE (order_date between '$lsunday' and '$lmonday') AND (rider_id = '$riderid')";
                                    $resultTest = mysqli_query($conn,$test);
                                    $num_row=mysqli_num_rows($resultTest);
                
                                echo "<td>";
                                echo "$num_row";
                                echo "</td>";
                                ?>
                            </tr>
                            <tr>
                                <th>Total commission (RM):</th>
                                <?php 
                                $totalRider=0;
                                    $test2 = "SELECT price FROM `orderlist` WHERE (order_date between '$lsunday' and '$lmonday') AND (rider_id = '$riderid')";
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
                        </table>
                    </div>
                    
                    <div class='column'>
                        <table class="calculateReport">
                            <tr>
                                <th colspan="2">Current Month (<?php echo "$df until $dl" ?>)</th>
                            </tr>
                            
                            <tr>
                                <th>Total order receive:</th>
                                <?php 
                                    $test = "SELECT * FROM orderlist WHERE (order_date between '$df' and '$dl') AND (rider_id = '$riderid')";
                                    $resultTest = mysqli_query($conn,$test);
                                    $num_row=mysqli_num_rows($resultTest);
                
                                echo "<td>";
                                echo "$num_row";
                                echo "</td>";
                                ?>
                            </tr>
                            <tr>
                                <th>Total commission (RM):</th>
                                <?php 
                                $totalRiderM=0;
                                    $month2 = "SELECT price FROM `orderlist` WHERE (order_date between '$df' and '$dl') AND (rider_id = '$riderid')";
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
                        </table>
                    </div>

                    <div class='column'>
                        <table class="calculateReport">
                            <tr>
                                <th colspan="2">Current Year (<?php echo "$yf until $yl" ?>)</th>
                            </tr>
                            
                            <tr>
                                <th>Total order receive:</th>
                                <?php 
                                    $test = "SELECT * FROM orderlist WHERE (order_date between '$yf' and '$yl') AND (rider_id = '$riderid')";
                                    $resultTest = mysqli_query($conn,$test);
                                    $num_row=mysqli_num_rows($resultTest);
                
                                echo "<td>";
                                echo "$num_row";
                                echo "</td>";
                                ?>
                            </tr>
                            <tr>
                                <th>Total commission (RM):</th>
                                <?php 
                                $totalRiderM=0;
                                    $month2 = "SELECT price FROM `orderlist` WHERE (order_date between '$yf' and '$yl') AND (rider_id = '$riderid')";
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
                        </table>
                    </div>
                </div>

                <div class="btn-group">
                    <a type="button" class="btn btn-info" href="rider_complaint.php">Back</a>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#weekly">Weekly</a>
                        <a class="dropdown-item" href="#monthly">Monthly</a>
                        <a class="dropdown-item" href="#yearly">Yearly</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Graph of Total Amount Of Commission</h4>
                    </div>
                    <div class="card-body">
                        <!--Graph-->
                        <script src="/assets/js/complaint_report_pie.js"></script>
                        <div class="col">
                            <canvas id="weekly" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="col">
                            <br>
                        </div>
                        <div class="col">
                            <canvas id="monthly" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <div class="col">
                            <br>
                        </div>
                        <div class="col">
                            <canvas id="yearly" style="width:100%;max-width:600px"></canvas>
                        </div>
                        <script>
                            var yWValues = [<?php echo "$rowlw[lw]" ?>, <?php echo "$rowcw[cw]" ?>];
                            var yMValues = [<?php echo "$rowm[m]" ?>];
                            var yYValues = [<?php echo "$rowy[y]" ?>];

                            new Chart("weekly", {
                                type: "pie",
                                data: {
                                    labels: ["Last Week", "Current Week"],
                                    datasets: [
                                        {
                                            backgroundColor: ["red", "orange"],
                                            data: yWValues
                                        }
                                    ]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Compare Total Commision Between (<?php echo "$cmonday until $csunday" ?>) And (<?php echo "$lsunday until $lmonday" ?>)"
                                    }
                                }
                            });

                            new Chart("monthly", {
                                type: "bar",
                                data: {
                                    labels: ["<?php echo "$df until $dl" ?>"],
                                    datasets: [{
                                        label: "Current Month",
                                        backgroundColor: "lightgreen",
                                        fill: false,
                                        tension: 0.1,
                                        data: yMValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Total Commision Monthly (<?php echo "$df until $dl" ?>)"
                                    }
                                }
                            });
                            new Chart("yearly", {
                                type: "bar",
                                data: {
                                    labels: ["<?php echo "$yf until $yl" ?>"],
                                    datasets: [{
                                        label: "Current Year",
                                        backgroundColor: "skyblue",
                                        data: yYValues
                                    }]
                                },
                                options: {
                                    title: {
                                        display: true,
                                        text: "Total Commision Yearly (<?php echo "$yf until $yl" ?>)"
                                    }
                                }
                            });
                        </script>
                    </div>
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