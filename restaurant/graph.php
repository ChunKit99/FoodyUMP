<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="restaurant")
    header("location:/logout.php");
?><!DOCTYPE html>
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

    </head>

    <!--body-->
    
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
                    

                <div id="highestLowest">
                <?php    

                $query = sprintf ("SELECT order_date, price FROM orderlist WHERE (order_date between '$monday' and '$sunday') AND (restaurant_id = '$restaurantid')");
                $result = mysqli_query($conn, $query);
                $data = array();
                    foreach ($result as $row){
                        $data[] = $row;
                    }

                    $result->close();
                    print json_encode($data);?>

               
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
