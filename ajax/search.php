<?php
include_once 'func/config.php';

$id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);

$sql = "SELECT * FROM users WHERE NOT unique_id = {$id} AND (fname LIKE '%{$searchTerm}%' OR lname LIKE '%{$searchTerm}%') ";
$output = "";
$query = mysqli_query($conn, $sql);
if(mysqli_num_rows($query) > 0){
    include_once "func/fetchdata.php";
}else{
    $output .= 'No user found related to your search term';
}
echo $output;

 ?>
