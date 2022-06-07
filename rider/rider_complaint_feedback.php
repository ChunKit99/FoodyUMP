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
    <title>Rider Complaint Feedback</title>
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
            <a href="rider_order.php" class="">Order</a>
            <a href="rider_delivery_record.php" class="">Records</a>
            <a href="rider_report.php" class="">Report</a>
            <a href="rider_complaint.php" class="" style="background: #11767ca6;">Complaint</a>
        </div>
    </div>
    <!--content-->
    <?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);
    $complaintid = $_GET['cid'];

    $query = "SELECT complaint.*, orderlist.user_id FROM complaint JOIN orderlist ON complaint.order_id=orderlist.order_id WHERE complaint_id = '$complaintid'; ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // output data
        while ($row1 = mysqli_fetch_assoc($result)) {
            $complaintid = $row1["complaint_id"];
            $userid = $row1["user_id"];
            $orderid = $row1["order_id"];
            $typeSelected = $row1["complaint_type"];
            $status = $row1["complaint_status"];
            $desc = $row1["complaint_desc"];
            $date = $row1["complaint_date"];
            $time = $row1["complaint_time"];
            $comment = $row1["complaint_comment"];
        }
    }
    //search user name baso no userid
    $sqlname = "SELECT `name` FROM `user` WHERE `user_id` = '$userid' ";
    $resultname = mysqli_query($conn, $sqlname);
    if (mysqli_num_rows($resultname) > 0) {
        while ($row = mysqli_fetch_array($resultname)) {
            $nameuser = $row['name'];
        }
    } else {
        $nameuser = "Undefine name, an error on database";
    }

    ?>
    <div id="page-content">
        <div class="page-main-content">
            <!--title-->
            <h1>Feedback to Complaint From User</h1>
            <div class="card">
                <div class="card-header">
                    Application Information
                </div>
                <div class="card-body">
                    <form method="post" action="complaint_update.php">
                        <!--Complaint id-->
                        <div class="form-group row">
                            <label for="complaintID" class="col-sm-2 col-form-label">Complaint ID</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' name='complaintID' value='$complaintid'>" ?>
                            </div>
                        </div>
                        <!--User id-->
                        <div class=" form-group row">
                            <label for="staticUserID" class="col-sm-2 col-form-label">User ID</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='staticUserID' value='$userid'>" ?>
                            </div>
                        </div>
                        <!--Name-->
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='staticName' value='$nameuser'>" ?>
                            </div>
                        </div>
                        <!--date-->
                        <div class="form-group row">
                            <label for="staticDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticDate" value=<?php echo $date ?>>
                            </div>
                        </div>
                        <!--time-->
                        <div class="form-group row">
                            <label for="staticTime" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticTime" value=<?php echo $time ?>>
                            </div>
                        </div>
                        <!--choose Order ID-->
                        <div class="form-group row">
                            <label for="chooseOrderID" class="col-sm-2 col-form-label">Order ID</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='chooseOrderID' value='$orderid'>" ?>
                            </div>
                        </div>
                        <!--choose type-->
                        <div class="form-group row">
                            <label for="chooseType" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='chooseType' value='$typeSelected'>" ?>
                            </div>
                        </div>
                        <!--description-->
                        <div class="form-group row">
                            <label for="descriptionComplaint" class="col-sm-2 col-form-label">Discription</label>
                            <div class="col-sm-10">
                                <textarea disabled class="form-control" rows="5" name="discriptionComplaint" maxlength='250'><?php echo $desc ?></textarea>
                            </div>
                        </div>
                        <!--status complaint-->
                        <div class="form-group row">
                            <label for="statusComplaint" class="col-sm-2 col-form-label">Status Complaint</label>
                            <div class="col-sm-10">
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <select class="custom-select mr-sm-2" name="statusComplaint">
                                            <?php
                                            $optionTypes = array('In Investigation', 'Resolved');

                                            foreach ($optionTypes as $optionType) {
                                                if ($status == $optionType) {
                                                    echo "<option selected value='$optionType'>$optionType</option>";
                                                } else {
                                                    echo "<option value='$optionType'>$optionType</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--comment-->
                        <div class="form-group row">
                            <label for="complaintComment" class="col-sm-2 col-form-label">Comment</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" name="complaintComment" maxlength='250' placeholder="Type in your comment"><?php echo $comment ?></textarea>
                            </div>
                        </div>
                        <!--button back-->
                        <div class="btn-group fr" role="group" aria-label="submit cancel button">
                            <input type="submit" class="btn btn-primary" value="Submit"></input>
                            <a href="rider_complaint.php"><button type="button" class="btn btn-secondary">Back</button></a>
                        </div>

                    </form>
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