<?php
session_start();
include '../db.php';
$id = $_SESSION['unique_id'];
$sql = "SELECT * FROM users WHERE NOT unique_id = ? ORDER BY user_id DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$results = $stmt->get_result();
$output = "";
if($results->num_rows == 0){
    $output .= "No users are available to chat";
}else{
    include_once "../func/fetchdata.php";
}
echo $output;
 ?>
