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
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/dbase.php";
                    include_once($path);
                    echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
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
            
            <?php 
            $menucat ="SELECT * FROM `menucategory` WHERE `restaurant_id`='$idshop'";
            $result2 = mysqli_query($conn, $menucat);
            echo "<div class='restaurant'>";  
            echo "<form method='post' action='user_cat_add.php?idshop=".$idshop."'>";
            echo "<select class='btn btn-info btn-lg' button onclick='myFunction()' class='dropbtn' name ='menu_category_id' id='menu_category_id'>";
            echo "<option value='0' disable selected>Select Category</option>";
            if (mysqli_num_rows($result) > 0) { 
                while ($row = mysqli_fetch_array($result2)) {
                    $menu_category_id = $row['menu_category_id'];  
                    $catname = $row['name'];
                    echo "<option value='$menu_category_id'>$catname</option>"; 
                    }
            }
            echo "</select>";
            echo "<br><br><br>";
            echo "<input type='submit' class='backbutton' class='btn btn-info btn-lg' formaction='user_cat_add.php?idshop=".$idshop."'>";      
            echo "</form>";
            echo "</div>";
           ?>

            <script>
                /* When the user clicks on the button, 
                toggle between hiding and showing the dropdown content */
                function myFunction() {
                  document.getElementById("myDropdown").classList.toggle("show");
                }
                
                // Close the dropdown if the user clicks outside of it
                window.onclick = function(event) {
                  if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                      var openDropdown = dropdowns[i];
                      if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                      }
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