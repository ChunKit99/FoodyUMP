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
            <a href="user_home.php" class="" style="background: #11767ca6;">Home</a>
            <a href="user_order.php" class="">Order</a>
            <a href="user_delivery.php" class="">Delivery</a>
            <a href="user_expenses.php" class="">Expenses</a>
            <a href="user_report.php" class="">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--woei chi-->
            <div class="menu">
                <div class="filter">
                    <h2>Menu</h2>
                    <input type="text" id="mySearch" onkeyup="filtering()" placeholder="Search.."
                        title="Type in a category">
                    <ul id="myMenu">
                        <li><?php 
                            // link restaurant table
                            $restaurant = "SELECT * FROM `restaurant`";   
                            //when result(row) more than 1
                            $result = mysqli_query($conn, $restaurant);
                            if (mysqli_num_rows($result) > 0) {  
                                while ($row = mysqli_fetch_array($result)) {
                                            $idshop = $row['restaurant_id'];
                                            $nameshop = $row['name'];
                                            echo "<a href='user_rest_profile.php?idshop=".$idshop."'>$nameshop</a>";
                                            echo "<br>";
                                    }
                                }
                            ?></li>
                    </ul>
                </div>
                
                <?php 
                // get rest id
                $idshop=$_GET['idshop'];
                $restaurant = "SELECT * FROM `restaurant` WHERE `restaurant_id` = '$idshop'";   
                //when result(row) more than 1
                $result = mysqli_query($conn, $restaurant);
                if (mysqli_num_rows($result) > 0) { 
                        while ($row = mysqli_fetch_assoc($result)) {
                            $idshop= $row['restaurant_id'];
                            $nameshop = $row['name'];
                            $locashop = $row['location'];
                            $opshop = $row['operation_time'];
                            $contactshop = $row['contact_num'];
                            $instashop = $row['instagram'];

                        echo "<div class='restaurant'>";
                        echo "<div class='profile'>";
                        echo "<h3>Restaurant Profile</h3>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>Restaurant Name:</td>";
                        echo "<td>$nameshop</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Location:</td>";
                        echo "<td>$locashop</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Operation Time:</td>";
                        echo "<td>$opshop</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Contact Number:</td>";
                        echo "<td>$contactshop</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>Instagram:</td>";
                        echo "<td>$instashop</td>";
                        echo "</tr>";
                        echo "</table>";
                    }
                    echo "</div>";
                    echo  "<br><br>";
                    echo "<a href='user_menu_add.php?idshop=".$idshop."'><button class='menubutton' class='btn btn-info btn-lg'>MENU</button></a>";
                    echo "<a href='user_home.php'><button class='backbutton' class='btn btn-info btn-lg'>BACK</button></a>";
                    echo "</div>";
                }

                ?>
            </div>
        </div>

    </div>

    <script>
        function filtering() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("mySearch");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myMenu");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
    <!--woei chi-->
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