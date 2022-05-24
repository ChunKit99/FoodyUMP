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
                <a href="restaurant_profile.html" class="" >Home</a>
                <a href="restaurant_food.html" class="" style="background: #11767ca6;">Food</a>
                <a href="restaurant_order.html" class="">Order</a>
                <a href="restaurant_report.html" class="">Report</a>
            </div>
        </div>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Add Food</h1>

                <form action="upload.php" method="post">
                <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
            </form>

            <div class="two_button">
                <button class="btn_add" onclick="foodAdd()">Add</button>
                <button class="btn_cancel" onclick="document.location='restaurant_food.html'">Cancel</button>
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
