<?php
session_start();
if(!isset($_SESSION['unique_id'])) {
  $_SESSION['is_logged'] = false;
}else {
  $_SESSION['is_logged'] = true;
}
include 'db.php';
 ?>
