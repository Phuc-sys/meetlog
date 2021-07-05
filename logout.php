<?php
    include_once 'func/config.php';

        $logout_id = $_GET['logout_id'];
        if(isset($logout_id)){
            $status = "Offline now";
            $sql = "UPDATE users SET status = ? WHERE unique_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $status, $logout_id);
            $stmt->execute();
            session_unset();
            session_destroy();
            header("location: index.php");
        }else{
            header("location: user.php");
        }
    
?>
