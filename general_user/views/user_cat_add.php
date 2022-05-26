<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/general.css">
    <script src="/assets/js/admin.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
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
            <div class="rest">
                <br><br><br>
                <h1><?php 
                $idshop=$_GET['idshop'];
                $restaurant = "SELECT * FROM `restaurant` WHERE `restaurant_id`='$idshop'";   
                //when result(row) more than 1
                      $result = mysqli_query($conn, $restaurant);
                      if (mysqli_num_rows($result) > 0) { 
                          while ($row = mysqli_fetch_array($result)) {
                              $nameshop = $row['name'];
                              echo "$nameshop";
                              echo "<br>";
                          }
                      }
                    ?></h1>
            </div>
            <div class="restaurant" >
            <?php
            $catid=$_GET['catid'];
            $status ="yes";
            $item ="SELECT * FROM `menuitem` WHERE menuitem.menu_category_id='$catid' AND menuitem.status_available= '$status'";
            $result3 = mysqli_query($conn, $item);
            $count = 0;
            if (mysqli_num_rows($result3) > 0){
                while ($row = mysqli_fetch_assoc($result3)) {
                    $count++;
                    $itemid = $row['menu_item_id'];
                    $itemphoto = $row['photo'];
                    $itemname = $row['name'];
                    $itemdes = $row['description']; 
                    $itemprice = $row['price']; 
                    $itemquantity = 2;

                    echo "<div class='cat1'>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>$itemphoto</td>";
                    echo "<td>$itemname</td>";
                    echo "<td>$itemdes</td>";
                    echo "<td>$itemprice</td>";
                    echo "<td>Quantity:<input type='number' id='quantity' value=$itemquantity></td>";
                    echo "<td><a href='user_order.php?idshop=".$idshop."?itemid=".$itemid."'><button class='button' class='btn btn-info btn-lg'>ADD</button></a></td>";
                    echo "</tr>";
                    echo "</table>";
                    echo "</div>";
                }
            echo "<a href='user_menu_add.php?idshop=".$idshop."'><button class='backbutton' class='btn btn-info btn-lg'>BACK</button></a>";
            }
            ?> 
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