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
        <link rel="stylesheet" href="/FoodyUMP/assets/css/global.css">
        <link rel="stylesheet" href="/FoodyUMP/assets/css/restaurant.css">
        <script src="/FoodyUMP/assets/js/admin.js"></script>
        <script src="/FoodyUMP/assets/js/restaurant.js"></script>
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
                <h3><?php echo $_SESSION['username'] ?></h3>
                <a href="/FoodyUMP/logout.php"><button class="logout">Logout</button></a>
                </div>
            </div>
        </div>

        <div id="nav-container">
            <div class="container-width nav-container">
                <a href="restaurant_profile.php" class="" >Home</a>
                <a href="restaurant_food.php" class="" style="background: #11767ca6;">Food</a>
                <a href="restaurant_order.php" class="">Order</a>
                <a href="restaurant_report.php" class="">Report</a>
            </div>
        </div>
  <!--to include the dbase.php-->
  <?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/FoodyUMP/dbase.php";
    include_once($path);
    $userid = $_SESSION["user_id"];
    $restaurantid= $_SESSION["restaurant_id"];

    //find menuCatagory using menu id

    $menuCatagory = "SELECT * FROM `menucategory` WHERE `restaurant_id` = '$restaurantid' ";
    $resultname = mysqli_query($conn, $menuCatagory);
    if (mysqli_num_rows($resultname) > 0) {
        while ($row = mysqli_fetch_array($resultname)) {
            $menuCategoryId1 = $row["menu_category_id"];
            $name = $row['name'];//ayam,mee,nasi
        }
    } else {
        $name = "Undefine catagory, an error on database";
    }   
    ?>
    
<?php
                //find menuItem using menuCatagory
                $menuItem = "SELECT * FROM `menuitem`";
                $result = mysqli_query($conn, $menuItem);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                      $menuItemId = $row["menu_item_id"];        
                      $menuCategoryId = $row["menu_category_id"];
                      $name = $row['name'];
                      $price = $row['price'];
                      $photo = $row['photo'];
                      $description = $row['description'];
                      $status_available = $row['status_available'];
                  }
                } else {
                      $name = "Undefine name, an error on database";
                }   
                ?>
        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Add Catagory / Food</h1>

            <div class="two_button">
             
   <?php        
        echo "<form action='addCatagory.php?cid=" . $restaurantid . "' method='post'>";
        echo "<input type='submit' class='btn_addFood' value='Category'>";
        echo "<input type='submit' formaction='addFood.php?cid=" . $restaurantid . "' method='post' class='btn_addFood' value='Food'>";
        echo "</form>";
    ?>
        
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