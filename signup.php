<?php
  include_once 'func/config.php';
  include_once "includes/header.php";
  include_once 'func/account.php';
  include_once 'func/filemanager.php';
$errors = [];
  if (isset($_POST['create'])) {
    $img_path = checkFile($_FILES, $errors, 5000000);
    if(empty($errors) && $img_path != false) {
        checkCreate($_POST, $img_path, $errors, $conn);
    }
  }
?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Register</header>
      <form action="signup.php" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" required>
          </div>
        </div>
        <p class="text-danger"><?php if(isset($errors['create_username'])) { echo $errors['create_username'];} ?></p>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <p class="text-danger"><?php if(isset($errors['create_email'])) { echo $errors['create_email'];} ?></p>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password1" placeholder="Enter new password" required>
          <!-- <i class="fas fa-eye"></i> -->
        </div>
        <div class="field input">
          <label>Confirm Password</label>
          <input type="password" name="password2" placeholder="Confirm your password" required>
          <!-- <i class="fas fa-eye"></i> -->
        </div>
        <p class="text-danger"><?php if(isset($errors['create_password'])) { echo $errors['create_password'];} ?></p>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <button type="submit" name="create" class="btn btn-outline-success">Create Account</button>
      </form>
      <div class="link">Already signed up? <a href="index.php">Login now</a></div>
    </section>
  </div>

  <script src="js/pass-show-hide.js"></script>

</body>
</html>
