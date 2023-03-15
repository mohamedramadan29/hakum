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
                                    <button type="submit" class="btn btn-primary btn-block"> ارسال <i class="fa fa-plane"></i> </button>
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
                        <?php
                        $stmt = $connect->prepare("SELECT * FROM travels WHERE travel_id=?");
                        $stmt->execute(array($travel_id));
                        $data = $stmt->fetch();
                        ?>
                        <p>الرحلة من :



                            <?php
                            $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                            $stmt->execute(array($data['travel_from_country']));
                            $country_data = $stmt->fetch();
                            $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                            $stmt->execute(array($data['travel_from_city']));
                            $city_data = $stmt->fetch();
                            echo $country_data['name'] . "-" . $city_data['name']
                            ?>
                            <br>
                            <span class="fa fa-arrow-left"></span> الي :

                            <?php
                            $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                            $stmt->execute(array($data['travel_to_country']));
                            $country_data = $stmt->fetch();
                            $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                            $stmt->execute(array($data['travel_to_city']));
                            $city_data = $stmt->fetch();
                            echo $country_data['name'] . "-" . $city_data['name']  ?>

                        </p>
                        <p> موعد الرحلة: <?php echo $data['travel_date'];  ?> </p>
                        <p> موعد الوصل المتوقع : <?php echo $data['travel_arrive_date'];  ?> </p>
                        <p> الوزن المتاح : <?php echo $data['av_weight'];  ?> كجم  </p>
                        <?php
                        if ($_SESSION['username'] === $data['user_name']) {
                        } else {
                        ?>
                            <form action="" method="post">
                                <label for="" style="color: red;"> ادخل سعر الصفقة المتفق علية (بالدولار) </label>
                                <br>
                                <br>
                                <input min="1" type="number" required class="form-control" name="deal_value" id="deal_value">
                                <br>
                                <button type="submit" class="btn btn-primary btn-sm"> اتمام الصفقة </button>
                            </form>
                            <?php
                            if (isset($_POST['deal_value']) && $_POST['deal_value'] != '' && is_numeric($_POST['deal_value'])) {
                                $deal_value = $_POST['deal_value'];
                                $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                                $stmt->execute(array($_SESSION['username']));
                                $userdata = $stmt->fetch();
                                $count = $stmt->rowcount();
                                if ($count > 0) {
                                    if ($userdata['balance'] >= $deal_value) {
                                        // insert travel to travels_deal done
                                        $stmt = $connect->prepare("INSERT INTO travel_deal (travel_id, travel_owner, product_owner , price)
                                        VALUE(:ztravel_id, :ztravel_owner , :zproduct_owner , :zprice)
                                        ");
                                        $stmt->execute(array(
                                            "ztravel_id" => $travel_id,
                                            "ztravel_owner" => $data['user_name'],
                                            "zproduct_owner" => $_SESSION['username'],
                                            "zprice" => $deal_value
                                        ));
                                        // discount value form users account
                                        $new_balance = $userdata['balance'] - $deal_value;
                                        $stmt = $connect->prepare("UPDATE users SET balance=?");
                                        $stmt->execute(array($new_balance));
                                        if ($stmt) {
                            ?>
                                            <br>
                                            <div class="alert alert-success"> راائع :: تم الاتفاق و عمل الصفقة بنجاح </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div>
                                            <p class="alert alert-danger"> من فضلك رصيد الحالي لا يسمح باتمام الصفقة </p>
                                            <a href="balance" class="btn btn-warning btn-sm"> اشحن الان </a>
                                        </div>
                            <?php
                                    }
                                }
                            }

                            ?>
                        <?php
                        }

                        ?>

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
                url: "msg/fetch_travel_msg.php?travel_id=" + travel_id + '&from=' + from + '&to=' + to,
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
