<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/global.css">
  <script src="/assets/js/admin.js"></script>
  <title>Login</title>

</head>
<body>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/dbase.php";
    include_once($path);

    ?>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>Welcome To Foody UMP</h2>
  <form id="login-form" onsubmit="validateUserType()">
    <p>
    <input type="text" id="username" name="username" placeholder="Username..." required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="password" id="password" name="password" placeholder="Password..." required><i class="validation"><span></span><span></span></i>
    </p>
    <p>
      <select name="userType" id="userType">
        <option value="administrator">Administrator</option>
        <option value="restaurantOwner">Restaurant Owner</option>
        <option value="generalUser">General User</option>
        <option value="rider">Rider</option>
      </select>
      <i class="validation"><span></span><span></span></i>
    </p>
    <p>
    <input type="submit" id="login" value="Login" onclick="validateUserType()">
    </p>
    <br>
  </form>
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>

    <div id="footer-container">
        <div class="footer-content">
            <div class="footer-links-a" style="margin-top: 20px"></div>
            <div class="copyright-info">
                <p>CopyRight © 2022 Foody UMP All Right Reserved</p>
            </div>
        </div>
    </div>

</html>
