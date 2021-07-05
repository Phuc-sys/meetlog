<?php
  include "func/config.php";
  if($_SESSION['is_logged'] == false){
  header("Location: index.php");
}
  include "includes/header.php";
  include 'func/usermanager.php';
  $user = getUser($_SESSION['unique_id'], $conn);

?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php if($user == false): ?>
            <h2 class="display-4">User Not Found!</h2>
          <?php else: ?>
          <a href="info.php"><img src="<?php echo $user['img']; ?>" alt=""></a>
          <div class="details">
            <span><?php echo $user['fname']. " " . $user['lname'] ?></span>
            <p><?php echo $user['status']; ?>
              <!-- if status is active now we will show up a dot indicates active status  -->
              <?= $user['status'] == 'Active now' ? '<span style="color: #468669;font-size:10px;"><i class="fas fa-circle"></i></span>' : '' ?></p>
          </div>
        </div>
        <a href="logout.php?logout_id=<?php echo $user['unique_id']; ?>" class="logout"><i class="fas fa-sign-out-alt"></i></a>
      </header>
      <div class="search">
        <span class="text">Select an user to start chat</span>
        <input type="text" placeholder="Type name to search...">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>
<?php endif; ?>
  <script src="js/users.js"></script>

</body>
</html>
