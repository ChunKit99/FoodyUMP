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
            <a href="user_home.php" class="">Home</a>
            <a href="user_order.php" class="" style="background: #11767ca6;">Order</a>
            <a href="user_delivery.php" class="">Delivery</a>
            <a href="user_expenses.php" class="">Expenses</a>
            <a href="user_report.php" class="">Report</a>
            <a href="user_complaint.php" class="">Complaint</a>
        </div>
    </div>

    <!--content-->
    <div id="page-content">
        <div class="page-main-content">
            <!--woeichi-->
            <div class="ordering">
                <br><br><br>
                <h1>My Order List</h1>
            </div>
            <br><br>

            <div class="orderlist">
                <table>
                    <tr>
                        <th>Food Name</th>
                        <th>Food Description</th>
                        <th>Price Per Item</th>
                        <th>Quantity</th>
                        <th>Action</th>

                    </tr>
                    <?php
                    //$foodquantity=$_GET['foodquantity'];
                    $cartedit="SELECT * FROM `cartorder` JOIN `menuitem` ON menuitem.menu_item_id=cartorder.menu_item_id";
                    $result= mysqli_query($conn, $cartedit);
                    if (mysqli_num_rows($result) > 0){
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            $count++;
                            $foodname = $row['name'];
                            $fooddes = $row['description']; 
                            $foodprice = $row['price']; 
                            $foodquantity=$row['quantity']; 
                            echo "<tr>";
                            echo "<td>$foodname</td>";
                            echo "<td>$fooddes</td>";
                            echo "<td>$foodprice</td>";
                            echo "<td><input type='number' id='quantity' value='$foodquantity'></td>";
                            echo "<td><a href='user_order.php?quantity=".$foodquantity."'><button class='savebutton'>SAVE</button></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    }            
                    ?>
                </table>
            </div>
            <!--woeichi-->
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