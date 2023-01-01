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
    $menuItemId=$_GET['id'];

    
                                     $menuItem = "SELECT * FROM `menuitem` WHERE `menu_item_id` = '$menuItemId' ";
                                     $resultname = mysqli_query($conn, $menuItem);
                                        if (mysqli_num_rows($resultname) > 0) {
                                            while ($row = mysqli_fetch_array($resultname)) {
                                                $menuCategoryId1 = $row["menu_category_id"];
                                                $name = $row['name'];
                                                $description = $row['description'];
                                                $price =$row['price'];
                                                $photo =$row['photo'];

                                                  }
                                            }
                                        
                            

    ?>
    

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Edit / Delete Food</h1>

        <?php
                echo "<form action='' method='post'>";
                echo "<table class='newCatagory'>";?>

                    <tr>
                        <th>Category:</th>
                        
                        <tr>
                            <td> 
                            <?php
                             $menuCategory = "SELECT menuitem.*, menucategory.name AS cName FROM `menuitem` JOIN `menucategory` ON menuitem.menu_category_id = menucategory.menu_category_id WHERE
                              `menu_item_id`=$menuItemId";
                             $resultname = mysqli_query($conn, $menuCategory);
                                if (mysqli_num_rows($resultname) > 0) {
                                    while ($row = mysqli_fetch_array($resultname)) {
                                        $menuCategoryId = $row["menu_category_id"];
                                        $cname = $row['cName'];
                            echo "<input type='text' readonly value='$cname' class='foodClass'></input>";}}?>

                             </td>
                         </tr>
 
                     <tr>
                         <th>
                             Name:
                         </th>
                     </tr>
                     <tr>
                         <td><?php echo "<input type='text' id='new_foodAdd' name='name' class='foodClass' value='$name'>";?></td>
                     </tr>
 
                     <tr>
                         <th>
                             Description:
                         </th>
                         </tr>
                         <tr>
                         <td><?php echo "<input type='text' id='new_descAdd' name='description' class='foodClass' value='$description'>";?></td>
                     </tr>
 
                     <tr>
                         <th>Price:</th>
                     </tr>
                     <tr>
                         <td><?php echo "<input type='text' id='new_priceAdd' name='price' class='foodClass' value='$price'>";?></td>
                     </tr>

                     <tr>
                         <th>Picture link:</th>
                     </tr>
                    
                     <tr>
                         <td><?php echo "<input type='text' class='foodClass' name='photo' value='$photo'>";?></td>
                     </tr>
                     
                     <tr>
                     <td><?php echo "<input type='text' class='foodClass' name='status_available' hidden readonly value='no'";?></td>
                     </tr>

                     

 

               
                    </table>
                    

            <div class="two_button">
                <input type="submit" formaction="food_edit_action.php?id=<?php echo $menuItemId ?>" method="post" value="Update" class="btn_edit">
                <input type="submit" class="btn_delete" formaction="food_delete_action.php?id=<?php echo $menuItemId ?>" value="Delete" method="post">
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
