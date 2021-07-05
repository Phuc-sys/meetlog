<?php
function checkFile($file, &$errors, $maxSize){
  $file = $file['image'];
  $ferror = $file['error'];
  $fname = $file['name'];
  $ftype = explode("/", $file['type']);
  $fext = end($ftype);
  $ftmp = $file['tmp_name'];
  $fsize = $file['size'];
  $allowed_ext = ['png','jpeg', 'jpg'];

  if ($ferror == 0) {
    if (!in_array($fext, $allowed_ext)) {
      $errors['ftype'] = "File extension is not allowed";
    }

    if($fsize > $maxSize){
      $errors['fsize'] = "File is larger than {$maxSize} bytes";
    }

    if(empty($errors)){
      $uniqe_id = uniqid('', false) . "." . $fext;
      $path = "images/" .$uniqe_id;
      if (move_uploaded_file($ftmp, $path)) {
        return $path;
      } else {
        $errors['fupload'] = "There was a error while uploading file";
        return false;
      }
    }
  } else {
    $errors['ferror'] = "Error!";
  }
}
 ?>
