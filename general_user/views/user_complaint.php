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
    <title>Foody UMP</title>
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
            <a href="user_home.html" class="">Home</a>
            <a href="user_order.html" class="">Order</a>
            <a href="user_expenses.html" class="">Expenses</a>
            <a href="user_report.html" class="">Report</a>
            <a href="user_complaint.php" class="" style="background: #11767ca6;">Complaint</a>
        </div>
    </div>
    <!--to include the dbase.php-->
    <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);
    $userid = "ca1";
    $name = "Ahmed Bin Ali";

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


    $query = "SELECT * FROM complaint WHERE `user_id` LIKE '$userid'  ";
    $resultList = mysqli_query($conn, $query);

    $queryweek = "SELECT SUM(CASE WHEN complaint_type = 'Late Delivery' THEN 1 ELSE 0 END) AS LateDelivery, SUM(CASE WHEN complaint_type = 'Damaged Food' THEN 1 ELSE 0 END) AS DamagedFood, SUM(CASE WHEN complaint_type = 'Missing Food' THEN 1 ELSE 0 END) AS MissingFood, SUM(CASE WHEN complaint_type = 'Incorrectly Charged' THEN 1 ELSE 0 END) AS IncorrectlyCharged, SUM(CASE WHEN complaint_type = 'Other' THEN 1 ELSE 0 END) AS Other FROM complaint WHERE complaint_date  between '$monday' and '$sunday' ";
    $querymonth = "SELECT SUM(CASE WHEN complaint_type = 'Late Delivery' THEN 1 ELSE 0 END) AS LateDelivery, SUM(CASE WHEN complaint_type = 'Damaged Food' THEN 1 ELSE 0 END) AS DamagedFood, SUM(CASE WHEN complaint_type = 'Missing Food' THEN 1 ELSE 0 END) AS MissingFood, SUM(CASE WHEN complaint_type = 'Incorrectly Charged' THEN 1 ELSE 0 END) AS IncorrectlyCharged, SUM(CASE WHEN complaint_type = 'Other' THEN 1 ELSE 0 END) AS Other FROM complaint WHERE complaint_date  between '$df' and '$dl' ";
    $querystatus = "SELECT SUM(CASE WHEN complaint_status = 'In Investigation' THEN 1 ELSE 0 END) AS InInvestigation, SUM(CASE WHEN complaint_status = 'Resolved' THEN 1 ELSE 0 END) AS Resolved FROM complaint";
    $resultweek = mysqli_query($conn, $queryweek);
    $resultmonth = mysqli_query($conn, $querymonth);
    $resultstatus = mysqli_query($conn, $querystatus);

    
    $roww = mysqli_fetch_assoc($resultweek);
    $rowm = mysqli_fetch_assoc($resultmonth);
    $rows = mysqli_fetch_assoc($resultstatus);

    ?>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--title and button-->
            <div class="fl">
                <h1>User Complaint List</h1>
            </div>
            <div class="fr">
                <a href="user_complaint_add.php">
                    <button type="button" class="btn btn-primary">New Complaint</button>
                </a>
                <a href="user_complaint_report.php">
                    <button type="button" class="btn btn-info">View Report</button>
                </a>
            </div>
            <!--table with summary-->
            <div class="container-width fl">
                <div class="text-center">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Weekly</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Late Delivery</td>
                                        <?php
                                        $temp = $roww['LateDelivery'];
                                         echo "<td>$temp</td>";
                                         ?>
                                    </tr>
                                    <tr>
                                        <td>Damaged Food</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Missing Food</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Incorrectly Charged</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td>12</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Monthly</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Late Delivery</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Damaged Food</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Missing Food</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Incorrectly Charged</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Other</td>
                                        <td>12</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>In Investigation</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Resolved</td>
                                        <td>12</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--user list-->
            <div class="container-width">
                <div class="text-center">
                    <table id="cList" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Complaint ID</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            if (mysqli_num_rows($resultList) > 0) {
                                // output data of each row
                                while ($row1 = mysqli_fetch_assoc($resultList)) {
                                    $count++;
                                    $complaintid = $row1["complaint_id"];
                                    $type = $row1["complaint_type"];
                                    $status = $row1["complaint_status"];
                                    $date = $row1["complaint_date"];
                                    $time = $row1["complaint_time"];
                                    echo "<tr>";
                                    echo "<th scope='row'>$complaintid</th>";
                                    echo "<td>$type</td>";
                                    echo "<td>$status</td>";
                                    echo "<td>$date</td>";
                                    echo "<td>$time</td>";
                                    echo "<td>";
                                    echo "<div class='btn-group' role='group'>";
                                    echo "<a href='user_complaint_edit.php?cid=" . $complaintid . "'><button type='button' class='btn btn-warning'>Edit</button></a>";
                            ?>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete<?php echo $count ?>">Delete</button>
                                    <?php
                                    echo "<a href='user_complaint_view.php?cid=" . $complaintid . "'>";
                                    echo "<button type='button' class='btn btn-info'>View</button></a>";
                                    ?>
                </div>
                </td>
                </tr>

                <!-- The Modal -->
                <div class="modal fade" id="confirmDelete<?php echo $count ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Delete Record</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <!-- Modal body -->
                            <div class="modal-body">
                                <p>Are you sure you want to delete your record?</p>
                                <div class="alert alert-danger" role="alert">
                                    Deleted record cannot undo.
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <a type="button" class="btn btn-danger" href="complaint_delete.php?cid=<?php echo $row1['complaint_id'] ?>">Confirm</a>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" class="cancelbtn">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                                }
                            }
        ?>
        </tbody>
        </table>

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