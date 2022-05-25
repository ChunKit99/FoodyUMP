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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/admin.js"></script>
    <title>Complaint</title>
</head>
<!--body-->

<body>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100">
            </div>
            <div class="topright-container fr">
                <h3>Username</h3>
                <button class="logout" onclick="logout()"> Logout</button>
            </div>
        </div>
    </div>
    <div id="nav-container">
        <div class="container-width nav-container">
            <a href="rider_home.php" class="">Home</a>
            <a href="rider_order.php" class="">Order</a>
            <a href="rider_report.html" class="">Report</a>
            <a href="rider_complaint.php" class="" style="background: #11767ca6;">Complaint</a>
        </div>
    </div>
    <!--to include the dbase.php-->
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);

    $riderid = $_GET['id'];
    //find ridername base on riderid
    $ridername = "abu";

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

    $queryweek = "SELECT SUM(CASE WHEN complaint_type = 'Late Delivery' THEN 1 ELSE 0 END) AS ld, SUM(CASE WHEN complaint_type = 'Damaged Food' THEN 1 ELSE 0 END) AS df, SUM(CASE WHEN complaint_type = 'Missing Food' THEN 1 ELSE 0 END) AS mf, SUM(CASE WHEN complaint_type = 'Incorrectly Charged' THEN 1 ELSE 0 END) AS ic, SUM(CASE WHEN complaint_type = 'Other' THEN 1 ELSE 0 END) AS ot FROM complaint JOIN orderlist ON complaint.order_id=orderlist.order_id WHERE (complaint_date  between '$monday' and '$sunday') AND (orderlist.rider_id = '$riderid'); ";
    $querymonth = "SELECT SUM(CASE WHEN complaint_type = 'Late Delivery' THEN 1 ELSE 0 END) AS ld, SUM(CASE WHEN complaint_type = 'Damaged Food' THEN 1 ELSE 0 END) AS df, SUM(CASE WHEN complaint_type = 'Missing Food' THEN 1 ELSE 0 END) AS mf, SUM(CASE WHEN complaint_type = 'Incorrectly Charged' THEN 1 ELSE 0 END) AS ic, SUM(CASE WHEN complaint_type = 'Other' THEN 1 ELSE 0 END) AS ot FROM complaint JOIN orderlist ON complaint.order_id=orderlist.order_id WHERE (complaint_date  between '$df' and '$dl') AND (orderlist.rider_id = '$riderid'); ";
    $querytotal = "SELECT SUM(CASE WHEN complaint_type = 'Late Delivery' THEN 1 ELSE 0 END) AS ld, SUM(CASE WHEN complaint_type = 'Damaged Food' THEN 1 ELSE 0 END) AS df, SUM(CASE WHEN complaint_type = 'Missing Food' THEN 1 ELSE 0 END) AS mf, SUM(CASE WHEN complaint_type = 'Incorrectly Charged' THEN 1 ELSE 0 END) AS ic, SUM(CASE WHEN complaint_type = 'Other' THEN 1 ELSE 0 END) AS ot FROM complaint JOIN orderlist ON complaint.order_id=orderlist.order_id WHERE (orderlist.rider_id = '$riderid'); ";
    $resultweek = mysqli_query($conn, $queryweek);
    $resultmonth = mysqli_query($conn, $querymonth);
    $resulttotal = mysqli_query($conn, $querytotal);


    $roww = mysqli_fetch_assoc($resultweek);
    $rowm = mysqli_fetch_assoc($resultmonth);
    $rowt = mysqli_fetch_assoc($resulttotal);

    ?>
    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--title-->
            <h1>Report of Complaint</h1>
            <div class="btn-group">
                <a type="button" class="btn btn-info" href="user_complaint.php">Back</a>
                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#weekly">Weekly</a>
                    <a class="dropdown-item" href="#monthly">Monthly</a>
                    <a class="dropdown-item" href="#overall">Overall</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Graph of Total Number Complaint
                </div>
                <div class="card-body">
                    <!--Graph-->
                    <script src="/assets/js/complaint_report_pie.js"></script>
                    <div class="col">
                        <canvas id="weekly" style="width:100%;max-width:600px"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="monthly" style="width:100%;max-width:600px"></canvas>
                    </div>
                    <div class="col">
                        <canvas id="overall" style="width:100%;max-width:600px"></canvas>
                    </div>
                    <script>
                        var xValues = ["Late Delivery", "Damaged Food", "Missing Food", "Incorrectly Charged", "Other"];

                        var yWValues = [<?php echo "$roww[ld]" ?>, <?php echo "$roww[df]" ?>, <?php echo "$roww[mf]" ?>, <?php echo "$roww[ic]" ?>, <?php echo "$roww[ot]" ?>];
                        var yMValues = [<?php echo "$rowm[ld]" ?>, <?php echo "$rowm[df]" ?>, <?php echo "$rowm[mf]" ?>, <?php echo "$rowm[ic]" ?>, <?php echo "$rowm[ot]" ?>];
                        var yTValues = [<?php echo "$rowt[ld]" ?>, <?php echo "$rowt[df]" ?>, <?php echo "$rowt[mf]" ?>, <?php echo "$rowt[ic]" ?>, <?php echo "$rowt[ot]" ?>];
                        var barColors = ["red", "green", "yellow", "blue", "purple"];

                        new Chart("weekly", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yWValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Total Number of Complaint Weekly (<?php echo "$monday until $sunday" ?>)"
                                }
                            }
                        });

                        new Chart("monthly", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yTValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Total Number of Complaint Monthly (<?php echo "$df until $dl" ?>)"
                                }
                            }
                        });
                        new Chart("overall", {
                            type: "pie",
                            data: {
                                labels: xValues,
                                datasets: [{
                                    backgroundColor: barColors,
                                    data: yMValues
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: "Total Number of Complaint Overall"
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