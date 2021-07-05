<?php
$errors = [];

function getUser($id, $conn){
  $sql = "SELECT * FROM users WHERE unique_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 1) {
    return $result->fetch_assoc();
  } else {
    return false;
  }
}

function updateUser($id, $fname, $lname, $img_path, $conn, $bool){
  $username = $fname . $lname;
  if(!minmaxChars($username, 5, 20)) {
    $errorMsg = "Username must be between 5-20 characters long!";
    $errors['edit_username'] = $errorMsg;
  }
  elseif ($bool == 0) {
    $sql = "UPDATE users SET fname = ?, lname = ?, img = ?
    WHERE unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $fname, $lname, $img_path, $id);
  } elseif ($bool == 1) {
    $sql = "UPDATE users SET fname = ?, lname = ?
    WHERE unique_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fname, $lname, $id);
  } else {
    echo "Invalid bool";
  }
  $stmt->execute();
  if($stmt->affected_rows == 1 && $stmt->errno == 0) {
    echo "<script>alert('Update successfully !');window.location.href='info.php';</script>";
}
}

function minmaxChars($string, $min, $max) {
  if(strlen($string) < $min || strlen($string) > $max) {
    return false;
  } else {
    return true;
  }
}

 ?>
