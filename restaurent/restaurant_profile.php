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
                <a href="restaurant_profile.php" class="" style="background: #11767ca6;">Home</a>
                <a href="restaurant_food.php" class="">Food</a>
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
    $restaurantid="1";

    ?>
    
        
        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>RESTAURANT PROFILE</h1>

                <form action="restaurant_profile_update.php?id=<?php echo $restaurantid ?>" method="post">
                <?php
    //find restaurant profile base on restaurant id
    $restaurantProfile = "SELECT * FROM `restaurant` WHERE `restaurant_id` = '$restaurantid' ";
    $resultname = mysqli_query($conn, $restaurantProfile);
    if (mysqli_num_rows($resultname) > 0) {
        while ($row = mysqli_fetch_array($resultname)) {
            $restaurantid = $row['restaurant_id'];
            $name = $row['name'];
            $location = $row["location"];
            $operation_time = $row["operation_time"];
            $contact_num = $row["contact_num"];
            $instagram = $row["instagram"];
        }
    } else {
        $name = "Undefine name, an error on database";
    }
    ?>
                <table class="res_profile">
                <?php echo "<input type='text' name='id' hidden readonly value='$restaurantid'>"?>
                <tr>
                        <th>Restaurant Name:</th>
                        </tr>
                        <tr>
                        <td><?php echo "<input type='text' name='name' value='$name' class='res_input' required>" ?></td>
                        <td><input type="checkbox" id="resName"name="res_pro_name" class="check_respro"></td>
                    </tr>
                    <tr>
                        <th>Restaurant Location:</th>
                    </tr>
                    <tr>
                    <td><?php echo "<input type='text' name='location' value='$location' class='res_input'>" ?></td>
                        <td><input type="checkbox" name="res_pro_location" class="check_respro"></td>
                    </tr>
                    <tr>
                        <th>Operation Time: </th>
                    </tr>
                    <tr>
                    <td><?php echo "<input type='text' name='operation_time' value='$operation_time' class='res_input'>" ?></td>
                        <td><input type="checkbox" name="res_pro_operation" class="check_respro"></td>
                    </tr>
                    <tr>
                        <th>Contact Number:</th>
                    </tr>
                    <tr>
                    <td><?php echo "<input type='text' name='contact_num' value='$contact_num' class='res_input'>" ?></td>
                        <td><input type="checkbox" name="res_pro_contact" class="check_respro"></td>
                    </tr>
                     <tr>
                         <th>Instagram:</th>
                     </tr>
                     <tr>
                     <td><?php echo "<input type='text' name='instagram' value='$instagram' class='res_input'>" ?></td>
                         <td><input type="checkbox" name="res_pro_insta" class="check_respro"></td>
                     </tr>
                     
                     
                            
                </table>

            <div class="two_button">
                <input type="submit" value="Update" class=btn_edit></input>
                <input type="submit" formaction="restaurant_profile_delete.php?id=<?php echo $restaurantid ?>" method="post" class="btn_delete" value="Delete">

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
