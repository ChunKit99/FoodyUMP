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
                <p>Username</p>
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
            <div class="payment">
                <br><br><br>
                <h1>Payment</h1>
            </div>
            <br><br>

            <div class="pay">
                <table>
                    <tr>
                        <th colspan="2">Delivery Detials</th>
                        <th colspan="2">Order Detials</th>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><form action="/x.php">
                            <input type="text" id="name" name="name">
                        </form></td>
                        <td>Food Name:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Phone Number:</td>
                        <td><form action="/x.php">
                            <input type="text" id="phone" name="phone">
                        </form></td>
                        <td>Food Description:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Delivery Address:</td>
                        <td><form action="/x.php">
                            <input type="text" id="address" name="address">
                        </form></td>
                        <td>Price Per Item:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Quantity:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="2">Payment Method</th>
                        <td>Delivery Price:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2"><div class="custom-select" style="width:300px;">
                            <select>
                              <option value="0">Select Payment Method</option>
                              <option value="0">Cash-On-Delivery</option>
                            </select>
                            </div>
                            </td>

                        <td>Total Price:</td>
                        <td></td>
                    </tr>
                </table>

                <br><br><br>
               <a href="user_delivery.html"><button class="confirmbutton" onclick="payment()">CONFIRM</button></a>  
               <a href="user_order.html"><button class="cancelbutton" onclick="payment()">CANCEL</button></a> 
            </div>
            
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