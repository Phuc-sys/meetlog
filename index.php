<?php
  include_once "func/config.php";
  include_once "includes/header.php";
  include_once "func/account.php";
  $errors = [];
  if (isset($_POST['login'])) {
    checkLogin($_POST, $errors, $conn);
  }

?>

<body>
  <div class="wrapper">
    <section class="form login">
      <img src="logo/logo.png" />
      <form action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <p class="text-danger"><?php if(isset($errors['login_email'])) {echo $errors['login_email'];} ?></p>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter your password" required>
          <i class="fas fa-eye"></i>
        </div>
        <p class="text-danger"><?php if(isset($errors['login_password'])) {echo $errors['login_password'];} ?></p>
        <button type="submit" name="login" class="btn btn-outline-primary">Login</button>
      </form>
      <div class="link">Not yet signed up? <a href="signup.php">Signup now</a></div>
      <a href="author.php" class="d-flex justify-content-center text-info">Contact Us</a>
    </section>
  </div>
  <script src="js/pass-show-hide.js"></script>
</body>
</html>
