<?php
session_start();
include "../connect.php";
$travel_id = $_GET['travel_id'];
$to = $_GET['to'];
$from = $_GET['from'];
$stmt = $connect->prepare("SELECT * FROM chat WHERE (msg_from = ? AND msg_to = ? AND travel_id=?) OR (msg_to = ? AND msg_from=? AND travel_id=?) ORDER BY id ");
$stmt->execute(array($from, $to, $travel_id,  $from, $to, $travel_id));
$count = $stmt->rowCount();
if ($count > 0) {
    $allmessage = $stmt->fetchAll();
    foreach ($allmessage as $msg) {
        if ($msg['msg_from'] == $_SESSION['username']) { ?>
            <div class="send_message sender_message">
                <div>
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                    $stmt->execute(array($_SESSION['username']));
                    $userdata = $stmt->fetch();
                    if (empty($userdata['profile_image'])) { ?>
                        <img src="uploads/profile.png" alt="">
                    <?php
                    } else {
                    ?>
                        <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                    <?php
                    }
                    ?>

                </div>
                <div class="message_info">
                    <p class="sender_name"> <?php echo  $_SESSION['username'] ?> </p>
                    <p class="sender_time"> <?php echo $msg['date'] ?> </p>
                    <p class="sender_m_data"> <?php echo $msg['msg'] ?>
                    </p>
                    <p class="sender_m_data"> <a target="_blank" href="uploads/"> الفايل </a> </p>
                </div>
            </div>
        <?php
        } else { ?>
            <div class="send_message recever_message">
                <div>
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                    $stmt->execute(array($username));
                    $userdata = $stmt->fetch();
                    if (empty($userdata['profile_image'])) { ?>
                        <img src="uploads/profile.png" alt="">
                    <?php
                    } else {
                    ?>
                        <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                    <?php
                    }
                    ?>
                </div>
                <div class="message_info">
                    <p class="sender_name"> <?php echo $username; ?> </p>
                    <p class="sender_time"> <?php echo $msg['date'] ?> </p>
                    <p class="sender_m_data"> <?php echo $msg['msg'] ?>
                    </p>
                </div>
            </div>
<?php
        }
    }
}
?>