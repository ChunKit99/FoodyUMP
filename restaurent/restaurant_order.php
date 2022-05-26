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
                <a href="restaurant_food.php" class="">Food</a>
                <a href="restaurant_order.php" class="" style="background: #11767ca6;">Order</a>
                <a href="restaurant_report.php" class="">Report</a>
            </div>
        </div>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Order Received</h1>

                <table class="orderList">
                    <tr>
                        <th>Order number</th>
                        <th>Status</th>
                        <th>Price (RM)</th>
                        <th>Rider</th>
                    </tr>
                    <tr>
                        <td onclick="document.location='orderDetail.html'" class="blue">AAAA111111</td>
                        <td>Prepared</td>
                        <td>21.00</td>
                        <td>Ahmad</td>
                    </tr>
                    <tr>
                        <td onclick="document.location='orderDetail.html'" class="blue">AAAA111112</td>
                        <td>Received</td>
                        <td>15.00</td>
                        <td>Joy</td>
                    </tr>
                </table>
                
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