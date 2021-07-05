<?php
  include_once 'func/config.php';
  include_once "includes/header.php";
  include_once 'func/filemanager.php';
  include_once 'func/usermanager.php';

  $userId = $_SESSION['unique_id'];
  $user = getUser($userId, $conn);
$errors = [];
  if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $id = $_SESSION['unique_id'];
    $img_path = true;
    //if file is not upload, bool default is 1
    $bool = 1;

    // if file is upload
    if($_FILES["image"]["error"] != 4) {
      $img_path = checkFile($_FILES, $errors, 5000000);
      $bool = 0;
    }
    if(empty($errors) && $img_path != false) {
        // update the post
        updateUser($id, $fname, $lname, $img_path, $conn, $bool);
    } else {
      echo $errors;
    }
  }
?>


<body>
<div class="wrapper">
    <section class="form signup" style="background-color:#FFEBCD;">
      <a class="text-info" href="info.php">Back</a>
      <header>Edit profile</header>
      <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>First Name</label>
            <input type="text" name="fname" placeholder="First name" value='<?= $user['fname'] ?>' required>
          </div>
          <div class="field input">
            <label>Last Name</label>
            <input type="text" name="lname" placeholder="Last name" value='<?= $user['lname'] ?>' required>
          </div>
        </div>
        <p class="error"><?php if(isset($errors['edit_username'])) {echo $errors['edit_username'];} ?></p>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        </div>
        <div class="field button">
          <input class="action-button" type="submit" name="submit" value="Update">
        </div>
      </form>
    </section>
  </div>
</body>
</html>
