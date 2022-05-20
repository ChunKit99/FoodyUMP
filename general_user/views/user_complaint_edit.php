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
    <!--content-->
    <?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);
    $complaintid = $_GET['cid'];
    $userid = "ca1";
    $name = "Ahmed Bin Ali";

    $query = "SELECT * FROM complaint WHERE `complaint_id` = '$complaintid'  ";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        // output data
        while ($row1 = mysqli_fetch_assoc($result)) {
            $complaintid = $row1["complaint_id"];
            $typeSelected = $row1["complaint_type"];
            $status = $row1["complaint_status"];
            $date = $row1["complaint_date"];
            $time = $row1["complaint_time"];
        }
    }    

    ?>
    <div id="page-content">
        <div class="page-main-content">
            <!--title-->
            <h1>Edit Complaint</h1>
            <div class="card">
                <div class="card-header">
                    Application Information
                </div>
                <div class="card-body">
                    <form>
                        <!--User id-->
                        <div class="form-group row">
                            <label for="staticUserID" class="col-sm-2 col-form-label">User ID</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='staticUserID' value='$userid'>"?>
                                
                            </div>
                        </div>
                        <!--Name-->
                        <div class="form-group row">
                            <label for="staticName" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <?php echo "<input type='text' readonly class='form-control-plaintext' id='staticName' value='$name'>"?>
                            </div>
                        </div>
                        <!--date-->
                        <div class="form-group row">
                            <label for="staticDate" class="col-sm-2 col-form-label">Date</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticDate" value=<?php echo $date?>>
                            </div>
                        </div>
                        <!--time-->
                        <div class="form-group row">
                            <label for="staticTime" class="col-sm-2 col-form-label">Time</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticTime" value=<?php echo $time?>>
                            </div>
                        </div>
                        <!--choose Order ID-->
                        <div class="form-group row">
                            <label for="chooseOrderID" class="col-sm-2 col-form-label">Order ID</label>
                            <div class="col-sm-10">
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            <option selected disabled><?php echo $complaintid?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--choose type-->
                        <div class="form-group row">
                            <label for="chooseType" class="col-sm-2 col-form-label">Choose Type</label>
                            <div class="col-sm-10">
                                <div class="form-row align-items-center">
                                    <div class="col-auto my-1">
                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                                            <option selected>Choose...</option>
                                            <option value="1">Late Delivery</option>
                                            <option value="2">Damaged Food</option>
                                            <option value="3">Missing Food</option>
                                            <option value="4">Incorrectly Charged</option>
                                            <option value="5">Other(State in description)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--description-->
                        <div class="form-group row">
                            <label for="descriptionComplaint" class="col-sm-2 col-form-label">Discription</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="5" id="discriptionComplaint"></textarea>
                            </div>
                        </div>
                        <!--button save and cancel-->
                        <div class="btn-group fr" role="group" aria-label="submit back button">
                            <button type="button" class="btn btn-primary">Save</button>
                            <a href="user_complaint.php"><button type="button" class="btn btn-secondary">Cancel</button></a>
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