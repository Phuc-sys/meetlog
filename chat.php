<?php
$maxSize = floatval(ini_get('post_max_size'));
 include 'func/config.php';
 include "includes/header.php";
 include 'func/usermanager.php';
// the user id from your list / get from fetchdata.php
 $user_id = $_GET['user_id'];
 $row = getUser($user_id, $conn);
?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <p><?php echo $row['status']; ?></p>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
          <div class="image-input" style="background-image: url('logo/icon.png');">
              <input type="file" name="image" id="image">
          </div>
          <input type="hidden" id="maxsize" value="<?= $maxSize; ?>"/>
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="js/chat.js"></script>

</body>
</html>
