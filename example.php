<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/complaint.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/admin.js"></script>
    <title>Complaint</title>
</head>
<!--body-->
   <!--to include the dbase.php-->
   <?php
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
        }
    } else {
        $name = "Undefine name, an error on database";
    }
    ?>


<body>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100">
            </div>
            <div class="topright-container fr">
                <h3><?php echo $name?></h3>
                <button class="logout" onclick="logout()"> Logout</button>
            </div>
        </div>
    </div>
    
 
    <!--content-->
    <div id="page-content">
        <div class="page-main-content">

        <?php 
        $idshop = "1";
        //all restaurant in database
        $sql2 = "SELECT * FROM `restaurant`";
        $result2 = mysqli_query($conn, $sql2);
        //when result(row) more than 1
        if (mysqli_num_rows($result2) > 0) {
            echo "<p>select_restaurant.php<p>";   
            echo "<p> Restaurant ID | Resaturant Name | location<p>";
            echo "<p> Point kat sini</p>";
            while ($row = mysqli_fetch_array($result2)) {
                $idshop = $row['restaurant_id'];
                $nameshop = $row['name'];
                $loca = $row['location'];
                echo "<p> $idshop | $nameshop | $loca<p>";
                
            }  

            echo "<p> we select restaurant_id = 1<p>";
            echo "<p>redirect to new page<p>";
            
            echo "<p>select_menu.php<p>";  
            //search menu if menu more 1
            echo "<p> search and display menu where res_id = 1<p>";  
            echo "<p> we select menu_id = 1<p>";
            echo "<p>redirect to new page<p>";
            echo "<p>select_category.php<p>";      
            $sql3 = "SELECT * FROM `menucategory` WHERE `menu_id` = 1";
            $result3 = mysqli_query($conn, $sql3);

            if (mysqli_num_rows($result3) > 0) {
                echo "<p> Category ID | Category Name <p>";
                while ($row = mysqli_fetch_array($result3)) {
                    $idcat = $row['menu_category_id'];
                    $namecat = $row['name'];
                    echo "<p> $idcat | $namecat <p>";
                }
            }

            echo "<p> we select menu_id = 1<p>";
            echo "<p>redirect to new page<p>";    

            $sql4 = "SELECT * FROM `menuitem` WHERE `menu_item_id` = 1";
            $result4 = mysqli_query($conn, $sql4);

            if (mysqli_num_rows($result4) > 0) {
                echo "<p> item ID | item Name <p>";
                while ($row = mysqli_fetch_array($result4)) {
                    $iditem = $row['menu_item_id'];
                    $nameitem = $row['name'];
                    echo "<p> $iditem | $nameitem <p>";
                }
            }

            echo "<p>select quantity, calculate price, ..., back to main page<p>"; 


        }else{
            echo"no restaurant found";
        }
        ?>

        


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