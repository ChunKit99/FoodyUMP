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
                <a href="restaurant_food.html" class="">Food</a>
                <a href="restaurant_order.html" class="">Order</a>
                <a href="restaurant_report.html" class="">Report</a>
            </div>
        </div>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Order Details</h1>

                <form action="">
                <table class="orderDetail">
                    <tr>
                        <th>Order Number:</th>
                    </tr>

                        <tr>
                           <td>AAAA11111X</td>
                        </tr>
                        
                        <tr>
                            <th>Food Order:</th>
                            <th>Quantity</th>
                        </tr>

                        <tr>
                            <td>Nasi Ayam</td>
                            <td>2</td>
                        </tr>

                        <tr>
                            <th>Deliver Address:</th>
                        </tr>

                        <tr>
                            <td>40,JALAN DAMAI,TAMAN DAMAI,PEKAN,PAHANG.</td>
                        </tr>

                    <tr>
                        <th>Status:</th>
                    </tr>

                    <tr>
                        <td><select name="f_Status" id="food_status">
                            <option value="received">Ordered</option>
                            <option value="prepared">Prepared</option>
                        </td>
                    </tr>

                </table>
                </form>

                <div class="three_button">
                <button class="btn_update" onclick="orderUpdate()">Update</button>
                <button class="btn_cancel" onclick="document.location='restaurant_order.html'">Cancel</button>
                <button class="btn_delete" onclick="orderDelete()">Delete</button>
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