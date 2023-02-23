<?php
$page_title = ' هاكم  - حسابي ';
session_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}
if (isset($_GET['user'])) {
    $username = $_GET['user'];
}
if (isset($_GET['travel_id']) && is_numeric($_GET['travel_id'])) {
    $travel_id = $_GET['travel_id'];
}
?>

<div class="chat_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="data" id="chat">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM chat WHERE (msg_from = ? AND msg_to = ? AND travel_id=?) OR (msg_to = ? AND msg_from=? AND travel_id=?) ORDER BY id ");
                    $stmt->execute(array($username, $_SESSION['username'], $travel_id,  $username, $_SESSION['username'], $travel_id));
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
                    <div class="form">
                        <form class="form-group insert ajax_form" action="" method="POST" autocomplete="on" enctype="multipart/form-data">
                            <div class="message_text">
                                <input type="hidden" name="from_person" id="from_person" value="<?php echo $_SESSION['username'] ?>">
                                <input type="hidden" name="to_person" value="<?php echo $username; ?>">
                                <input type="hidden" name="travel_id" value="<?php echo $travel_id; ?>">
                                <textarea required name="message_data" id=""></textarea>
                                <div class="send_message_button">
                                    <button name="send_message" id="send_message" type="submit" class="btn btn-primary"> ارسال <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="chat_reason">
                    <h2>معلومات</h2>
                    <div class="info">
                        <p>تواصل مع المستخدم بشان طلب التعاقد</p>
                        <div class="alert alert-info"> تم اتمام التعاقد مع المتدرب من قبل <i class="fa fa-check"></i></div>
                        <div class="chat_com_option">
                            <div class="company_review">
                                <form action="" method="post">
                                    <textarea placeholder="من فضلك اكتب تقيمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                    <input class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقيم  ">
                                </form>
                            </div>
                        </div>
                        <div class="chat_com_option">
                            <div class="company_review">
                                <form action="" method="post">
                                    <textarea placeholder="من فضلك اكتب تقيمك للمنصة" name="com_review" id="" class="form-control"></textarea>
                                    <input class="btn btn-primary" name="send_review" type="submit" value="   ارسال التقيم  ">
                                </form>
                                <?php
                                if (isset($_POST['send_review'])) {
                                    $review = $_POST['com_review'];
                                    $stmt = $connect->prepare("INSERT INTO company_review (com_id, com_review) VALUES (:zcom_id,:zcom_review)");
                                    $stmt->execute(array(
                                        "zcom_id" => $_SESSION['com_id'],
                                        "zcom_review" => $review,
                                    ));
                                    if ($stmt) {
                                ?>
                                        <div class="alert alert-success"> شكرا لك علي تقيمك لمنصة انتقاء </div>
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $("#send_message").click(function() {
            let msg = $("#message_data").val();
            let from_person =
                $.ajax({

                    type: "POST",
                    url: "msg/send_travel_msg.php",
                    data: {
                        msg: msg
                    },
                    success: function() {
                        $("#msg").val('');
                    }

                });

        });

    });
</script>


<?php

include $tem . 'footer.php';
