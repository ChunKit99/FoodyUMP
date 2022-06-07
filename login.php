<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/global.css">
  <script src="/assets/js/admin.js"></script>
  <title>Login</title>

</head>

<body>
  <!-- partial:index.partial.html -->
  <div id="login-form-wrap">
    <h2>Welcome To Foody UMP</h2>
    <form id="login-form" action="loginprocess.php" method="POST">
      <p>
        <input type="text" id="username" name="username" placeholder="Username..." required><i class="validation"><span></span><span></span></i>
      </p>
      <p>
        <input type="password" id="password" name="password" placeholder="Password..." required><i class="validation"><span></span><span></span></i>
      </p>
      <p>
        <select name="userType" id="userType">
          <option value="administrator">Administrator</option>
          <option value="restaurant">Restaurant Owner</option>
          <option value="generaluser">General User</option>
          <option value="rider">Rider</option>
        </select>
      </p>
        <input type="submit" id="login" name="sub" value="Login">
      <br>
      <br>
      <?php
      $msg='';
      if (isset($_REQUEST["err"]))
        $msg = "Invalid username or Password or User type";
      ?>
      <p style="color:red;">
        <?php if (isset($msg)) {
          echo $msg;
        }
        ?>
      </p>
    </form>
  </div>
  <!--login-form-wrap-->
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