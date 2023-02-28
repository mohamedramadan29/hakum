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
                    <div id="demo">

                    </div>
                    <div class="form">
                        <form class="form-group" action="javascript:void(0)" id="ajax-form" method="POST" autocomplete="on" enctype="multipart/form-data">
                            <div class="message_text">
                                <input type="hidden" name="from_person" id="from_person" value="<?php echo $_SESSION['username'] ?>">
                                <input type="hidden" name="to_person" id="to_person" value="<?php echo $username; ?>">
                                <input type="hidden" name="travel_id" id="travel_id" value="<?php echo $travel_id; ?>">
                                <textarea required name="msg" id="msg"></textarea>
                                <div class="send_message_button">
                                    <input type="submit" class="btn btn-primary" name="submit" value="submit">
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
<script src="https://code.jquery.com/jquery-3.4.1.js"></script>

<!-- to fetch message -->

<script type="text/javascript">
    $(document).ready(function() {
        setInterval(function() {
            let from = $("#from_person").val();
            let to = $("#to_person").val();
            let travel_id = $("#travel_id").val();
            $.ajax({
                type: "POST",
                url: "msg/fetch_travel_msg.php?travel_id=" +travel_id + '&from=' + from + '&to=' + to,
                dataType: "html",
                success: function(data) {
                    $('#demo').html(data);
                }
            });
        }, 1000);
    });
</script>




<!-- to insert message -->
<script type="text/javascript">
    $(document).ready(function($) {

        $('#ajax-form').submit(function(e) {
            e.preventDefault();
            let msg = $("#msg").val();
            let from_person = $("#from_person").val();
            let to_person = $("#to_person").val();
            let travel_id = $("#travel_id").val();
            $.ajax({
                type: "POST",
                url: "msg/send_travel_msg",
                data: {
                    msg: msg,
                    from_person: from_person,
                    to_person: to_person,
                    travel_id: travel_id
                },
                success: function() {
                    $("#msg").val('');
                    $("#demo").load();
                }

            });

        });

    });
</script>


<?php

include $tem . 'footer.php';
