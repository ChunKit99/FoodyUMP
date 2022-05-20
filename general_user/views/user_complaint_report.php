<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/complaint.css">
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
            integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
            crossorigin="anonymous"
        >
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
                    <img
                        src="/assets/img/logo_foody_ump.jpg"
                        alt="logo"
                        width="200"
                        height="100"
                    >
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
        <div id="page-content">
            <div class="page-main-content">
                <!--title-->
                <h1>Report of Complaint</h1>
                <div class="dropdown">
                    <button
                        class="btn btn-secondary dropdown-toggle"
                        type="button"
                        id="dropdownGraphMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        Choose Graph:
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownGraphMenuButton">
                        <a class="dropdown-item" href="#">Type of Complaint</a>
                        <a class="dropdown-item" href="#">Status of Complaint</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="user_complaint.php">Back to Complaint Page</a>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Graph of Report
                    </div>
                    <div class="card-body">
                        <!--Graph-->
                        <script src="/assets/js/complaint_report_pie.js"></script>
                        <div class="row">
                            <div class="col">
                                <canvas id="weekly" style="width:100%;max-width:600px"></canvas>
                            </div>
                            <div class="col">
                                <canvas id="monthly" style="width:100%;max-width:600px"></canvas>
                            </div>
                        </div>
                        <script>
                            var xValues = ["Late Delivery", "Damaged Food", "Missing Food", "Incorrectly Charged", "Other"];
                            var yWValues = [5, 10, 7, 15, 8];
                            var yMValues = [10, 15, 13, 20, 12];
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
                                    text: "Total Number of Complaint Weekly"
                                    }
                                }
                                });

                            new Chart("monthly", {
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
                                    text: "Total Number of Complaint Monthly"
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
