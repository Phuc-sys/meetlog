<?php
session_start();
include '../db.php';
    include '../func/filemanager.php';
$errors = [];
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id =  $_POST['incoming_id'];
        $message = htmlspecialchars($_POST['message']);
        $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
        // if file is upload
        if($_FILES['image']['error'] != 4) {
          //$img_path = checkFile($_FILES, $errors, 5000000);
          //if ($img_path != false) {
            // $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, is_image) VALUES (?,?,?,?)";
            // $stmt = $conn->prepare($sql);
            // $stmt->bind_param("iisi", $incoming_id, $outgoing_id, $img_path, 1);
            // $stmt->execute();
            // return;
            $image = $_FILES['image'] ?: '';
            $imageName = $image['name'];
            $imageTmp  = $image['tmp_name'];
            // Avoid duplicate image name.
            $imageName = time() . $imageName;
            if(move_uploaded_file($imageTmp, "../images/" . $imageName)){
              $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, is_image)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$imageName}', 1)") or die();
              return;
            }
          //}
        }elseif(!empty($message)){
            $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $incoming_id, $outgoing_id, $message);
            $stmt->execute();
            // $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, chat_color)
            // VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$color}')") or die();
        }
?>
