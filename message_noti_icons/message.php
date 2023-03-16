<li class="nav-item notification dropdown" aria-labelledby="navbarDropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-envelope nav-link"></i> </a>
    <span class="noti_num">
        <?php
        $stmt = $connect->prepare("SELECT COUNT(*) as unread_msg ,  msg_from, travel_id, msg FROM chat WHERE msg_to=? AND noti_show=0 GROUP BY msg_from, travel_id, msg
              ORDER BY MAX(id) DESC");
        $stmt->execute(array($_SESSION['username']));
        $allchats = $stmt->fetchAll();
        $count = $stmt->rowCount();
        if ($count > 0) {
            echo $count;
        }
        ?> </span>
    <ul class="dropdown-menu chat_not_box" aria-labelledby="navbarDropdown">
        <?php
        if ($count > 0) {
            foreach ($allchats as $chat) {
        ?>
                <li>
                    <a class="dropdown-item" href="message?user=<?php echo $chat['msg_from']; ?>&travel_id=<?php echo $chat['travel_id']; ?>">
                        <?php
                        $msg = $chat['msg'];
                        $msg = explode(' ', $msg);
                        $msg = implode(' ', array_slice($msg, 0, 8)) . "...";
                        echo $msg ?> </a>
                </li>
            <?php
            }
        } else {
            $stmt = $connect->prepare("SELECT * FROM chat WHERE msg_to=? ORDER BY id DESC LIMIT 15");
            $stmt->execute(array($_SESSION['username']));
            $allchats = $stmt->fetchAll();
            foreach ($allchats as $chat) {
            ?>
                <li style="display: flex;">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM users WHERE name = ? LIMIT 1");
                    $stmt->execute(array($chat['msg_from']));
                    $user_profile = $stmt->fetch();
                    if (!empty($user_profile['profile_image'])) {
                    ?>
                        <img src="website_uploads/<?php echo $user_profile['profile_image']; ?>" alt="">
                    <?php
                    } else {
                    ?>
                        <img src="uploads/profile.png" alt="">
                    <?php
                    }
                    ?>

                    <a class="dropdown-item" href="message?user=<?php echo $chat['msg_from']; ?>&travel_id=<?php echo $chat['travel_id']; ?>">
                        <?php
                        $msg = $chat['msg'];
                        $msg = explode(' ', $msg);
                        $msg = implode(' ', array_slice($msg, 0, 8)) . "...";
                        echo $msg ?> </a>
                </li>
        <?php
            }
        }
        ?>
    </ul>
</li>