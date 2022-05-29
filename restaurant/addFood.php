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
    <?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="restaurant")
    header("location:/logout.php");
?>
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
    $userid = $_SESSION["user_id"];
    $restaurantid= $_SESSION["restaurant_id"];

    ?>
    

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Add Food</h1>

        <?php
                echo "<form action='Food_insert.php?id=' . $restaurantid . '' method='post'>";
                echo "<table class='newCatagory'>";?>

                    <tr>
                        <th>Category:</th>
                        
                        <tr>
                            <td> 
                           <?php
                                    echo "<select name='f_Catagory' id='food_catagory' >";
                                    $menuCatagory = "SELECT * FROM `menucategory` WHERE `restaurant_id` = '$restaurantid' ";
                                     $resultname = mysqli_query($conn, $menuCatagory);
                                        if (mysqli_num_rows($resultname) > 0) {
                                            while ($row = mysqli_fetch_array($resultname)) {
                                                $menuCategoryId1 = $row["menu_category_id"];
                                                $name = $row['name'];//ayam,mee,nasi
                                                
                                                echo "<option value='$menuCategoryId1'>$name</option>";

                                                  }
                                            }
                                            echo "</select>";
                                        
                            ?>
                             </td>
                         </tr>
 
                     <tr>
                         <th>
                             Name:
                         </th>
                     </tr>
                     <tr>
                         <td><?php echo "<input type='text' id='new_foodAdd' name='f_name' class='foodClass'>";?></td>
                     </tr>
 
                     <tr>
                         <th>
                             Description:
                         </th>
                         </tr>
                         <tr>
                         <td><?php echo "<input type='text' id='new_descAdd' name='description' class='foodClass'>";?></td>
                     </tr>
 
                     <tr>
                         <th>Price:</th>
                     </tr>
                     <tr>
                         <td><?php echo "<input type='text' id='new_priceAdd' name='price' class='foodClass'>";?></td>
                     </tr>

                     <tr>
                         <th>Picture link:</th>
                     </tr>
                    
                     <tr>
                         <td><?php echo "<input type='text' class='foodClass' name='photo'>";?></td>
                     </tr>
                    
                     <tr>
                         <td><?php echo "<input type='text' class='foodClass' name='status_available' hidden readonly value='no'";?></td>
                     </tr>
                    </table>
                    

            <div class="two_button">
                <input type="submit" value="Add" class="btn_add">
                <?php
                echo "<input type='submit' class='btn_cancel' formaction='restaurant_food.php?id=' . $restaurantid . '' value='Cancel' method='post'>";
                ?>
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
