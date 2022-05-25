<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/global.css">
        <link rel="stylesheet" href="/assets/css/restaurant.css">
        <script src="/assets/js/admin.js"></script>
        <script src="/assets/js/restaurant.js"></script>
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
                    <p>Username</p>
                    <button class="logout" onclick="logout()"> Logout</button>
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
    $path .= "/dbase.php";
    include_once($path);
    $userid = "3";
    $restaurantid="5";

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
                <h1>CATAGORIES</h1><sup class="red">*Minimum 10 foods must be published</sup> <br> <sup class="red">*Minimum 3 catagories</sup>

                <form action="" method="post">

                <?php
                    $menuCatagory = "SELECT * FROM `menucategory` ";
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
                           echo "<th>Select</th>";
                           echo "<th>Publish</th>";
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
                        echo "<td><img src=$photo alt='Mee Hoon Soup' width='100' height='100'></td>";
                        echo "<td>$name</td>";
                        echo "<td>$description</td>";
                        echo "<td>$price</td>";
                        echo "<td><input type='checkbox' name='foot_cat[$menuItemId]' class='check_respro'></td>";
                        echo "<td>$status_available</td>";

                       }}
                     }

                    }
                    }
                 
                    echo "</table>";
                    ?>
                

                <div class="four_button">
                <input type="submit" formaction="resAdd.php" method="post" class="btn_add" value="Add">
                <input type="submit" formaction="editFood.php" method="post" class="btn_edit" value="Edit">
                <input type="submit" formaction="foodDelete.php" method="post" class="btn_delete" value="Delete">
                <input type="submit" formaction="foodPublish.php" method="post" class="btn_publish" value="Publish">

         
            </div>
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
