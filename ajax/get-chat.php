<?php
session_start();
include '../db.php';

    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = $_POST['incoming_id'];
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $message = '';
            if ($row['is_image']) {
                $message = '<a target="_blank" href="images/'.$row['msg'].'">
                <img src="images/'.$row['msg'].'" class="picture"/></a>';
            } else {
                $message = $row['msg'];
            }
            //you chat on right side chatbox
            if ($row['outgoing_msg_id'] === $incoming_id) {
              $output .= '<div class="chat incoming ">
                              <img src='.$row['img'].' alt="">
                              <div class="details">
                                  <p style="background: ">
                                  ' . $message . '<br>
                                  <span class="time-ago">' . date('d/m/Y h:i:s',strtotime($row['created_at'])) . '</span>
                                  </p>
                              </div>
                              </div>';
            // user chat on the left side chatbox
            } else {
              $output .= '<div class="chat outgoing">
                              <div class="details">
                                  <p style="background: #fff">
                                  ' . $message . '<br>
                                  <span class="time-ago">' . date('d/m/Y h:i:s',strtotime($row['created_at'])) . '</span>
                                  </p>
                              </div>
                              </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }
    echo $output;

?>
