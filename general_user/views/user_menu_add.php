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
            <div class="rest">
                <br><br><br>
                <h1><?php 
                    // link restaurant table
                    $restaurant = "SELECT * FROM `restaurant`";
                    $result = mysqli_query($conn, $restaurant);
                            if (mysqli_num_rows($result) > 0) { 
                                while ($row = mysqli_fetch_assoc($result)) {
                                        $nameshop = $row['name'];
                                        echo  $nameshop ;
                                    }
                                }   
                    ?></h1>
            </div>
            <?php 
          
                    echo "<div class='category-container'>";
                    echo" <a href='user_menu_add.php'>";
                        $category = "SELECT * FROM `menucategory`";
                        $result2 = mysqli_query($conn, $category);
                    if (mysqli_num_rows($result2) > 0) { 
                        while ($row = mysqli_fetch_assoc($result2)) {
                            $catid = $row['menu_category_id'];    
                            $catname = $row['name'];
                            echo  "<p>$catid</p>";
                            echo  "<p>$catname</p>";
                        }
                    } 
                    ?>
                </a>
            </div>

            <?php
             $cat_id=1;
            $id = "SELECT 'menu_category_id' FROM `menuitem` WHERE 'menu_categoty_id'='$cat_id'";
            $item ="SELECT * FROM `menuitem`";
            $result3 = mysqli_query($conn, $id);
            if($cat_id == 'menu_category_id'){

            echo "<div class='cat1'>";
            echo "<table>";
            echo "<tr>";
            echo "<td style='width:100px;height:100px;'>";
            if (mysqli_num_rows($result3) > 0) { 
                while ($row = mysqli_fetch_assoc($result3)) {
                    $itemphoto = $row['photo'];    
                     echo  $itemphoto. "<br>";
                }
            } 
            echo "</td>";
            echo "<td>";
            if (mysqli_num_rows($result3) > 0) { 
                while ($row = mysqli_fetch_assoc($result3)) {
                     $itemname = $row['name'];    
                    echo  $itemname. "<br>";
                }
            }
            echo"</td>";
            echo "<td>";
            if (mysqli_num_rows($result3) > 0) { 
                while ($row = mysqli_fetch_assoc($result3)) {
                     $itemdes = $row['description'];    
                    echo  $itemdes. "<br>";
                }
            } 
            echo "</td>";
            echo "<td>";  
            if (mysqli_num_rows($result3) > 0) { 
                while ($row = mysqli_fetch_assoc($result3)) {
                    $itemprice = $row['price'];    
                    echo  $itemprice. "<br>";
                }
            } 
            echo "</td>";

            echo "<td>Quantity:<input type='number' id='quantity'></td>";
            echo "<td><button class='button' class='btn btn-info btn-lg' data-toggle='modal' data-target='#add'
                                onclick='order()'>ADD</button></td>";

            echo "</tr>";
            echo "</table>";
            echo "</div>";
            }?>

            <div class="modal fade" id="add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Order List</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <p>Successfully Added.</p>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                class="cancelbtn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
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