<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/general.css">
    <script src="/assets/js/admin.js"></script>
    <title>Foody UMP</title>
</head>

<!--body-->

<body>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
                <p><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/dbase.php";
                    include_once($path);
                    $userid = "1";

                //find user name base on userid
                    $sqlname = "SELECT `name` FROM `user` WHERE `user_id` = '$userid' ";
                    $resultname = mysqli_query($conn, $sqlname);
                    if (mysqli_num_rows($resultname) > 0) {
                        while ($row = mysqli_fetch_array($resultname)) {
                             $name = $row['name'];
                            echo "$name";
                         }
                    } else {
                      $name = "Undefine name, an error on database";
                      }
                    ?></p>
                <button class="logout" onclick="logout()"> Logout</button>
            </div>
        </div>
    </div>

    <div id="nav-container">
        <div class="container-width nav-container">
            <a href="user_home.php" class="" style="background: #11767ca6;">Home</a>
            <a href="user_order.html" class="">Order</a>
            <a href="user_delivery.html" class="">Delivery</a>
            <a href="user_expenses.html" class="">Expenses</a>
            <a href="user_report.html" class="">Report</a>
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
                        <li><a href="user_rest_profile.php"><?php 
                            // link restaurant table
                            $restaurant = "SELECT * FROM `restaurant`";    
                            //when result(row) more than 1
                            $result = mysqli_query($conn, $restaurant);
                            if (mysqli_num_rows($result) > 0) {  
                                while ($row = mysqli_fetch_array($result)) {
                                        $idshop = $row['restaurant_id'];
                                        $nameshop = $row['name'];
                                        echo "$nameshop";
                                    }
                                }
                            ?></a></li>
                    </ul>
                </div>

                <div class="restaurant">
                    <div class="profile">
                        <h3>Restaurant Profile</h3>
                        <table>
                            <tr>
                                <td>Restaurant Name:</td>
                                <td> <?php     
                                    //when result(row) more than 1
                                    $result = mysqli_query($conn, $restaurant);
                                        if (mysqli_num_rows($result) > 0) { 
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                 $nameshop = $row['name'];
                                                echo $nameshop ;
                                             }
                                        }
                            ?></td>
                            </tr>
                            <tr>
                                <td>Location:</td>
                                <td><?php     
                                    //when result(row) more than 1
                                    $result = mysqli_query($conn, $restaurant);
                                        if (mysqli_num_rows($result) > 0) { 
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                 $locashop = $row['location'];
                                                echo $locashop ;
                                             }
                                        }
                            ?></td>
                            </tr>
                            <tr>
                                <td>Operation Time:</td>
                                <td><?php     
                                    //when result(row) more than 1
                                    $result = mysqli_query($conn, $restaurant);
                                        if (mysqli_num_rows($result) > 0) { 
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                 $opshop = $row['operation time'];
                                                echo $opshop ;
                                             }
                                        }
                            ?></td>
                            </tr>
                            <tr>
                                <td>Contact Number:</td>
                                <td><?php     
                                    //when result(row) more than 1
                                    $result = mysqli_query($conn, $restaurant);
                                        if (mysqli_num_rows($result) > 0) { 
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                 $contactshop = $row['contact_num'];
                                                echo $contactshop ;
                                             }
                                        }
                            ?></td>
                            </tr>
                            <tr>
                                <td>Instagram:</td>
                                <td><?php     
                                    //when result(row) more than 1
                                    $result = mysqli_query($conn, $restaurant);
                                        if (mysqli_num_rows($result) > 0) { 
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                 $instashop = $row['instagram'];
                                                echo $instashop ;
                                             }
                                        }
                            ?></td>
                            </tr>
                        </table>
                    </div>
                    <br><br>
                    <a href="user_menu_add.php"><button class="menubutton" class="btn btn-info btn-lg">MENU</button></a>
                    <a href="user_home.php"><button class="backbutton" class="btn btn-info btn-lg">BACK</button></a>
                </div>
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