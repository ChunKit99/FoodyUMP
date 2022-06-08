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
<?php
session_start();
if (!isset($_SESSION["login"]))
    header("location:/login.php");
if($_SESSION["user_type"]!="generaluser")
    header("location:/logout.php");
?>
    <div id="logo">
        <div class="container-width">
            <div class="fl logo">
                <img src="/assets/img/logo_foody_ump.jpg" alt="logo" width="200" height="100" />
            </div>
            <div class="topright-container fr">
            <h3><?php
                    $path = $_SERVER['DOCUMENT_ROOT'];
                    $path .= "/dbase.php";
                    include_once($path);
                    echo $_SESSION['username'] ?></h3>
                <a href="/logout.php"><button class="logout">Logout</button></a>
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
            <?php
            echo "<div class='payment'>";
            echo "<br><br><br>";
            echo "<h1>Payment</h1>";
            echo "</div><br><br>";
            echo "<div class='pay'>";
            echo "<form method='post' action='user_paydb.php'>";
            echo "<table>";
            echo "<tr>";
            echo "<th colspan='2'>Delivery Detials</th>";
            echo "<th colspan='2'>Order Detials</th>";
            echo "</tr>";

            $cart_id=$_GET['cart_id'];
            $userid = $_SESSION['user_id'];
            $username = $_SESSION['username'];

            $pay="SELECT * FROM `cartorder` JOIN `menuitem` JOIN `menucategory` ON menuitem.menu_item_id=cartorder.menu_item_id AND menuitem.menu_category_id=menucategory.menu_category_id WHERE cartorder.cart_id =  $cart_id";
            $result= mysqli_query($conn, $pay);
            if (mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)) {

                    $idshop = $row['restaurant_id'];
                    $itemid = $row ['menu_item_id'];
                    $foodname = $row['name'];
                    $fooddes = $row['description']; 
                    $foodprice = $row['price']; 
                    $quantity=$row['quantity']; 

                    echo "<tr>";
                    echo "<td>Name:</td>";
                    echo "<td>$username</td>";

                    echo "<td>Food Name:</td>";
                    echo "<td>$foodname</td>";
                    echo "</tr><tr>";
                    echo "<td>Phone Number:</td>";
                    echo "<td><input type='text' id='phone' name='phone'></td>";
                    echo "<td>Food Description:</td>";
                    echo "<td>$fooddes</td>";
                    echo "</tr><tr>";
                    echo "<td>Delivery Address:</td>";
                    echo "<td><input type='text' id='address' name='address'></td>";
                    echo "<td>Price Per Item (RM):</td>";
                    echo "<td>$foodprice</td></tr><tr>";
                    echo "<td colspan='2'></td>";
                    echo "<td>Quantity:</td>";
                    echo "<td>$quantity</td>";
                    echo "</tr><tr>";
                    echo "<th colspan='2'>Payment Method</th>";
                    echo "<td>Delivery Price (RM):</td>";
                    echo "<td>4.00</td>";
                    echo "</tr><tr>";
                    echo "<td colspan='2'><div class='custom-select' style='width:300px;'>";
                    echo "<select>";
                    echo "<option value='0'>Select Payment Method</option>";
                    echo "<option value='0'>Cash-On-Delivery</option>";
                    echo "</select>";
                    echo "</div></td>";
                    echo "<td>Total Price (RM):</td>";
                    $price=($foodprice*$quantity)+4;
                    $price=number_format($price,2);
                    echo "<td>$price</td>";
                    echo "</tr>";
                    echo "</table>";
                }
            }
            echo "<br><br><br>";
            echo "<input type='submit' value='CONFIRM' class='confirmbutton' formaction='user_paydb.php?cart_id=".$cart_id."&idshop=".$idshop."&itemid=".$itemid."&quantity=".$quantity."&price=".$price."'>"; 
            echo "</form>";
            echo "<a href='user_order.php'><button class='cancelbutton'>CANCEL</button></a> ";
            echo "</div>";

            ?>     
            <script>
                var x, i, j, l, ll, selElmnt, a, b, c;
                /*look for any elements with the class "custom-select":*/
                x = document.getElementsByClassName("custom-select");
                l = x.length;
                for (i = 0; i < l; i++) {
                  selElmnt = x[i].getElementsByTagName("select")[0];
                  ll = selElmnt.length;
                  /*for each element, create a new DIV that will act as the selected item:*/
                  a = document.createElement("DIV");
                  a.setAttribute("class", "select-selected");
                  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
                  x[i].appendChild(a);
                  /*for each element, create a new DIV that will contain the option list:*/
                  b = document.createElement("DIV");
                  b.setAttribute("class", "select-items select-hide");
                  for (j = 1; j < ll; j++) {
                    /*for each option in the original select element,
                    create a new DIV that will act as an option item:*/
                    c = document.createElement("DIV");
                    c.innerHTML = selElmnt.options[j].innerHTML;
                    c.addEventListener("click", function(e) {
                        /*when an item is clicked, update the original select box,
                        and the selected item:*/
                        var y, i, k, s, h, sl, yl;
                        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                        sl = s.length;
                        h = this.parentNode.previousSibling;
                        for (i = 0; i < sl; i++) {
                          if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                              y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                          }
                        }
                        h.click();
                    });
                    b.appendChild(c);
                  }
                  x[i].appendChild(b);
                  a.addEventListener("click", function(e) {
                      /*when the select box is clicked, close any other select boxes,
                      and open/close the current select box:*/
                      e.stopPropagation();
                      closeAllSelect(this);
                      this.nextSibling.classList.toggle("select-hide");
                      this.classList.toggle("select-arrow-active");
                    });
                }
                function closeAllSelect(elmnt) {
                  /*a function that will close all select boxes in the document,
                  except the current select box:*/
                  var x, y, i, xl, yl, arrNo = [];
                  x = document.getElementsByClassName("select-items");
                  y = document.getElementsByClassName("select-selected");
                  xl = x.length;
                  yl = y.length;
                  for (i = 0; i < yl; i++) {
                    if (elmnt == y[i]) {
                      arrNo.push(i)
                    } else {
                      y[i].classList.remove("select-arrow-active");
                    }
                  }
                  for (i = 0; i < xl; i++) {
                    if (arrNo.indexOf(i)) {
                      x[i].classList.add("select-hide");
                    }
                  }
                }
                /*if the user clicks anywhere outside the select box,
                then close all select boxes:*/
                document.addEventListener("click", closeAllSelect);
                </script>
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