<?php
function checkCreate($post, $img_path, &$errors, $conn){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $username = $fname . $lname;
  $email = $_POST['email'];
  $pw1 = $_POST['password1'];
  $pw2 = $_POST['password2'];

  if(!minmaxChars($username, 5, 20)) {
    $errorMsg = "Username must be between 5-20 characters long!";
    $errors['create_username'] = $errorMsg;
  } elseif (checkForUser($email, $conn) == 1 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errorMsg = "Email already sign up or invalid email";
    $errors['create_email'] = $errorMsg;
  }

  // check pw length and matching
  if(!minmaxChars($pw1, 5, 20)|| $pw1 != $pw2) {
    $errorMsg = "Password is too short or does not match!";
    $errors['create_password'] = $errorMsg;
  }

  // if there are no errors, insert the user into the db and login
  if(empty($errors)) {
    $user_id = createUser($fname, $lname, $email, $pw1, $img_path, $conn);
    if($user_id != 0) {
      loginUser($email, $user_id, $conn);
    }
  }
}

function checkLogin($post, &$errors, $conn){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(checkForUser($email, $conn) != 1) {
    $errorMsg = "Email not sign up yet!";
    $errors['login_email'] = $errorMsg;
  } else {
    // if user exists, get their record and check the user submitted pw
    // against the hash in the DB
    $user_row = getUserRow($email, $conn);
    if(!password_verify($password, $user_row['user_hash'])) {
      $errorMsg = "Incorred Password!";
      $errors['login_password'] = $errorMsg;
    }
  }
  // if there are no errors in the array then login and redirect
  if(empty($errors)) {
    loginUser($user_row['email'], $user_row['unique_id'], $conn);
  }
}

function checkForUser($email, $conn) {
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $results = $stmt->get_result();
  return $results->num_rows;
}

function createUser($fname, $lname, $email, $password, $img_path, $conn){
  //or use md5() for password
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $ran_id = rand(time(), 100000000);
  $status = "Active now";
  $sql = "INSERT INTO users (fname, lname, email, user_hash, unique_id, status, img) VALUES (?,?,?,?,?,?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssiss", $fname, $lname, $email, $hash, $ran_id, $status, $img_path);
  $stmt->execute();
  if($stmt->affected_rows == 1) {
    return $ran_id;
  } else {
    return 0;
  }
}

function minmaxChars($string, $min, $max) {
  if(strlen($string) < $min || strlen($string) > $max) {
    return false;
  } else {
    return true;
  }
}

function getUserRow($email, $conn) {
  $sql = "SELECT * FROM users WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function loginUser($email, $user_id, $conn) {
  $_SESSION['email'] = $email;
  $_SESSION['unique_id'] = $user_id;
  $status = "Active now";
  $sql = "UPDATE users SET status = ? WHERE unique_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $status, $user_id);
  $stmt->execute();
  header("Location: user.php");
}
 ?>
