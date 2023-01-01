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
                <h1>CATAGORIES</h1>
                <?php 
                $test = "SELECT menuitem.*, menucategory.menu_category_id, menucategory.restaurant_id FROM `menuitem` JOIN menucategory ON 
                menuitem.menu_category_id=menucategory.menu_category_id WHERE `status_available`='Yes' AND `restaurant_id` =  '$restaurantid'";
                $resultTest = mysqli_query($conn,$test);
                $num_row=mysqli_num_rows($resultTest);
               
               if ($num_row >= 10){
                echo "<sup class='green'>Minimum food to publish achieve</sup>";
                } else {
                echo "<sup class='red'>*Minimum 10 foods must be published</sup>";
                }
                ?>

                <?php 
                $test1 = "SELECT COUNT(menuitem.menu_category_id), menucategory.menu_category_id, menucategory.restaurant_id FROM `menuitem` JOIN 
                menucategory ON menuitem.menu_category_id=menucategory.menu_category_id WHERE `status_available`='Yes' AND `restaurant_id` = '$restaurantid' 
                GROUP BY `menu_category_id`";
                $resultTest1 = mysqli_query($conn,$test1);
                $num_row=mysqli_num_rows($resultTest1);
               
               if ($num_row >= 3){
                echo "<br><sup class='green'>Minimum category to publish achieve</sup>";
                } else {
                echo "<br><sup class='red'>*Minimum 3 catagories</sup>";
                }
                ?>

                <form action="" method="post">
                <?php
                echo "<div class='one_button'>";
                echo "<input type='submit' formaction='resAdd.php' method='post' class='btn_add' value='Add'>";
                echo "</div>";
                ?>
                <?php
                    $menuCatagory = "SELECT * FROM `menucategory`  WHERE `restaurant_id` = '$restaurantid' ";
                    $resultname = mysqli_query($conn, $menuCatagory);
                    if (mysqli_num_rows($resultname) > 0) {
                        while ($row = mysqli_fetch_array($resultname)) {
                            $menuCategoryId1 = $row["menu_category_id"];
                            $name = $row['name'];//ayam,mee,nasi

                           echo "<table id='cat_mee'>";
                           echo "<tr>";                 

                           echo "<h2> $name </h2>";

                           echo "<th>Picture</th>";
                           echo "<th>Name</th>";
                           echo "<th>Description</th>";
                           echo "<th>Price (RM)</th>";
                           echo "<th>Publish</th>";
                           echo "<th>Publish Status</th>";
                            echo "</tr>";

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
                        if ($menuCategoryId1 == $menuCategoryId) {

                          echo "<tr>";
                        echo "<td><img src=$photo alt=$name width='100' height='100'></td>";
                        echo "<td><a href='choose_action.php?id=".$menuItemId."'>$name</a></td>";
                        echo "<td>$description</td>";
                        echo "<td>$price</td>";
                        echo "<td>";
                        echo "<input type='submit' name='foot_cat[]'  value='Publish' formaction='foodPublish.php?id=" . $menuItemId . "' method='post'></input>";
                        echo "<input type='submit' name='foot_cat2[]'  value='Unpublish' formaction='foodUnpublish.php?id=" . $menuItemId . "' method='post'></input>";
                        echo "</td>";
                        echo "<td>$status_available</td>";

                       }}
                     }

                    }
                    }
                 
                    echo "</table>";
                    ?>
                    
<!--Stuck at how to pass array of publish-->
                
                
        </form>
         
    
    
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
