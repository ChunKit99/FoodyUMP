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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>

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
                <a href="restaurant_order.php" class="">Order</a>
                <a href="restaurant_report.php" class="" style="background: #11767ca6;">Report</a>
            </div>
        </div>

        <!--content-->
        <div id="page-content">
            <div class="page-main-content">
                <h1>Report</h1>

                <label for="timeframe">Timeframe: </label>
                    <select name="timeframe" id="timeframe">
                        <option value="daily">Day</option>
                        <option value="weekly">Week</option>
                        <option value="monthly">Month</option>
                        <option value="yearly">Year</option>
                    </select>
                    
                    <table class="calculateReport">
                        <tr>
                            <th>Total order receive:</th>
                            <td>x</td>
                        </tr>
                        <tr>
                            <th>Total income:</th>
                            <td>xx</td>
                        </tr>
                        <tr>
                            <th>Total commission to rider:</th>
                            <td>xxx</td>
                        </tr>
                        <tr>
                            <th>Total commission to Foody:</th>
                            <td>xxxx</td>
                        </tr>
                        <tr>
                            <th>Accumulated income:</th>
                            <td>xxxxx</td>
                        </tr>
                    </table>
                </form>

                <div id="highestLowest">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(hLIncome);

                    function hLIncome() {
                       var data = new google.visualization.DataTable();
                      data.addColumn('date', 'Date');
                      data.addColumn('number', 'Income');

                      data.addRows([
                      [new Date(2022,0,1), 42],   [new Date(2022,0,2), 10],  [new Date(2022,0,3), 23],  [new Date(2022,0,4), 17],  
                      [new Date(2022,0,5), 18],  [new Date(2022,0,6), 9],  [new Date(2022,0,7), 27],  [new Date(2022,0,8), 33],  
                      [new Date(2022,0,9), 40],  [new Date(2022,0,10), 32], [new Date(2022,0,11), 35],  [new Date(2022,0,12), 30], 
                      [new Date(2022,0,13), 40], [new Date(2022,0,14), 42], [new Date(2022,0,15), 47], [new Date(2022,0,16), 44], 
                      [new Date(2022,0,17), 48],  [new Date(2022,0,18), 52], [new Date(2022,0,19), 54], [new Date(2022,0,20), 42], 
                      [new Date(2022,0,21), 55], [new Date(2022,0,22), 56], [new Date(2022,0,23), 57],  [new Date(2022,0,24), 60], 
                      [new Date(2022,0,25), 50], [new Date(2022,0,26), 52], [new Date(2022,0,27), 51], [new Date(2022,0,28), 49], 
                      [new Date(2022,0,29), 53],  [new Date(2022,0,30), 55], [new Date(2022,0,31), 60]
                      ]);

                      var options = {
                        hAxis: {
                            format: 'dd',
                            title: 'Date'
                        },
                        vAxis: {
                            title: 'Income (Month)'
                        }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('highestLowest'));
                    chart.draw(data, options);
                }
            </script>               
                </div>

                <div id="numberOrders">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(graphOrder);

                    function graphOrder() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('date', 'Date');
                        data.addColumn('number', 'numOrder');

                        data.addRows([
                      [new Date(2022,0,1), 4],   [new Date(2022,0,2), 1],  [new Date(2022,0,3), 3],  [new Date(2022,0,4), 7],  
                      [new Date(2022,0,5), 8],  [new Date(2022,0,6), 9],  [new Date(2022,0,7), 7],  [new Date(2022,0,8), 3],  
                      [new Date(2022,0,9), 4],  [new Date(2022,0,10), 3], [new Date(2022,0,11), 5],  [new Date(2022,0,12), 3], 
                      [new Date(2022,0,13), 4], [new Date(2022,0,14), 4], [new Date(2022,0,15), 7], [new Date(2022,0,16), 4], 
                      [new Date(2022,0,17), 8],  [new Date(2022,0,18), 5], [new Date(2022,0,19), 5], [new Date(2022,0,20), 4], 
                      [new Date(2022,0,21), 5], [new Date(2022,0,22), 6], [new Date(2022,0,23), 7],  [new Date(2022,0,24), 6], 
                      [new Date(2022,0,25), 5], [new Date(2022,0,26), 2], [new Date(2022,0,27), 5], [new Date(2022,0,28), 9], 
                      [new Date(2022,0,29), 3],  [new Date(2022,0,30), 5], [new Date(2022,0,31), 6]
                      ]);

                      var options = {
                        hAxis: {
                            format: 'dd',
                            title: 'Date'
                            },
                            vAxis: {
                                title: 'Number of Orders (Month)'
                            }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('numberOrders'));
                        chart.draw(data, options);
                    }
            </script>               
                </div>

                <div id="accIncome">
                    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                    <script type="text/javascript"> 
                    google.charts.load('current', {packages: ['corechart', 'line']});
                    google.charts.setOnLoadCallback(graphAccumulateIncome);

                    function graphAccumulateIncome() {
                        var data = new google.visualization.DataTable();
                        data.addColumn('date', 'year');
                        data.addColumn('number', 'accumulateIncome');

                        data.addRows([
                        [new Date(2020,0,1), 2050],   [new Date(2021,0,1), 5045],  [new Date(2022,0,1), 5784]
                        ]);

                        var options = {
                            hAxis: {
                                format:'yyyy',
                                title: 'Year'
                            },
                            vAxis: {
                                title: 'Accumulate Income'
                            }
                        };

                        var chart = new google.visualization.LineChart(document.getElementById('accIncome'));
                        chart.draw(data, options);
                    }
            </script>               
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
