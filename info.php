<?php

  include_once "func/config.php";
  include_once "func/usermanager.php";
  include_once "includes/header.php";
  $userId = $_SESSION['unique_id'];
  $user = getUser($userId, $conn);
?>
<style>
.card_ava {
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

.action-button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
  text-decoration: none;
  font-size: 22px;
  color: white;
}

.action-button:hover {
  opacity: 0.7;
}
</style>

<body>
<div class="wrapper">
    <section class="form" style="background-color:#FFEBCD;">
        <a class="text-info" href="user.php">Back</a>
        <div class="card_ava">
            <img src="<?= $user['img']; ?>" style="width:100%">
            <h1><?= $user['fname'].' '.$user['lname'] ?></h1>
            <p style="margin-bottom:1rem;" class="title"><?= $user['email'] ?></p>
            <p><a class="action-button" href="edit.php">Edit</a></p>
        </div>
    </section>
</div>
</body>
</html>
