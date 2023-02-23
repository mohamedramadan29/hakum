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
?>
<div class="chat_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="data" id="chat">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM chat WHERE (msg_from = ? AND msg_to = ?) OR (msg_to = ? or msg_from=?) ORDER BY id ");
                    $stmt->execute(array($username, $_SESSION['username'],  $username, $_SESSION['username']));
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
                                <input type="hidden" name="to_person" value="<?php echo $other_person ?>">
                                <textarea required name="message_data" id=""></textarea>
                                <div class="send_message_button">
                                    <button name="send_message" type="submit" class="btn btn-primary"> ارسال <i class="fa fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </form>
                        <?php
                        if (isset($_POST['send_message'])) {
                            $from = $_SESSION['username'];
                            $to = $username;
                            $msg = $_POST['message_data'];
                            $date = date("Y-m-d h:i:sa"); 
                            $stmt = $connect->prepare("INSERT INTO chat (msg_from, msg_to, msg, date)
                            value(:zfrom, :zto, :zmsg , :zdate)
                            ");
                            $stmt->execute(array(
                                "zfrom" => $from,
                                "zto" => $to,
                                "zmsg" => $msg,
                                "zdate" => $date,
                            ));
                        }

                        ?>
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
    function calc() {
        var subtotal = document.getElementById("sub_total").value;
        var discount = document.getElementById("discount").value;
        var total = document.getElementById("total").value;

        var discount_val = subtotal * 5 / 100;

        var total_val = subtotal - discount_val;

        document.getElementById('discount').value = discount_val;
        document.getElementById('total').value = total_val;
    }
</script>


<?php

include $tem . 'footer.php';
