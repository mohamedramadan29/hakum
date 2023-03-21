<?php
$page_title = ' هاكم  - حسابي ';
session_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}

$stmt = $connect->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute(array($_SESSION['username']));
$userdata = $stmt->fetch();
?>
<div class="profile">
    <div class="container-fluid">
        <div class="data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="slide1">
                        <div class="personal_image">
                            <?php
                            if ($userdata['profile_image'] != "") {
                            ?>
                                <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                            <?php
                            } else {
                            ?>
                                <img src="uploads/profile.png" <?php
                                                            }
                                                                ?> <h3> <?php echo $userdata['name']; ?> </h3>
                        </div>
                        <div class="control_setting">
                            <h6> لوحة التحكم </h6>
                            <br>
                            <div class="row">

                                <div class="col-4">
                                    <a href="profile">
                                        <div class="control_setting_section">
                                            <i class="fa fa-user"></i>
                                            <p> حسابي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="add_product">
                                        <div class="control_setting_section ">
                                            <i class="fa fa-plus"></i>
                                            <p> اضافة شحنة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="add_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plus"></i>
                                            <p> اضافة رحلة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_product">
                                        <div class="control_setting_section">
                                            <i class="fa fa-book"></i>
                                            <p> شحناتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plane"></i>
                                            <p> رحلاتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="balance">
                                        <div class="control_setting_section active">
                                            <i class="fa fa-dollar"></i>
                                            <p> الرصيد </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="deals">
                                        <div class="control_setting_section">
                                            <i class="fa fa-handshake"></i>
                                            <p> صفقاتي </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="slide2">
                        <?php
                        if (isset($_POST['with_draw_money'])) {
                            $request_money = $_POST['withdraw_total'];
                            $paypal_email = filter_var($_POST['paypal_email'], FILTER_SANITIZE_EMAIL);
                            $formerror = [];

                            if ($request_money < 10) {
                                $formerror[] = 'من فضلك ادخل مبلغ اكبر من 10 دولار ';
                            }
                            $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                            $stmt->execute(array($_SESSION['username']));
                            $withuser = $stmt->fetch();
                            $userbalance = $withuser['balance'];
                            if ($userbalance < $request_money) {
                        ?>
                                <li class="alert alert-danger"> رصيدك الحالي لا يسمح بعمل هذا الطلب </li>
                                <?php
                                $formerror[] = ' رصيدك الحالي لا يسمح بعمل هذا الطلب  ';
                            } elseif ($userbalance >= $request_money && empty($formerror)) {
                                $new_balance = $userbalance - $request_money;
                                $stmt = $connect->prepare("INSERT INTO withdraw (user,email,price)
                            VALUE(:zuser,:zemail,:zprice)
                            ");
                                $stmt->execute(array(
                                    "zuser" => $_SESSION['username'],
                                    "zemail" => $paypal_email,
                                    "zprice" => $request_money
                                ));
                                $stmt = $connect->prepare("UPDATE users SET balance=? WHERE name=?");
                                $stmt->execute(array($new_balance, $_SESSION['username']));
                                if ($stmt) {
                                ?>
                                    <p class="alert alert-success"> تم طلب سحب اموال بنجاح يستغرق طلب السحب عادة اقل من 24 ساعه </p>
                                <?php
                                }
                            } else {
                                foreach ($formerror as $error) {
                                ?>
                                    <li class="alert alert-danger"> <?php echo $error; ?> </li>
                        <?php
                                }
                            }
                        }


                        ?>
                        <div class="balance_section">

                            <div class="balance_num" style="display: flex; justify-content: space-between; width:100%">
                                <div>
                                    <h3> الرصيد الكلي </h3>
                                    <span> <?php echo $userdata['balance']; ?> دولار </span>

                                </div>
                                <?php 
                                $stmt = $connect->prepare("SELECT SUM(price) as total_withdraw  FROM withdraw WHERE user=? AND status = 0");
                                $stmt->execute(array($_SESSION['username']));
                                $result = $stmt->fetch();
                                $count = $stmt->rowCount();
                                if($count > 0){
                                    $total_withdraw = $result['total_withdraw'];
                                    ?>
                                    <div>
                                    <h3> طلبات السحب </h3>
                                    <span> <?php echo $total_withdraw; ?> دولار </span>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdraw">
                                        سحب رصيد
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="add_balance">
                            <h6> شحن الرصيد </h6>
                            <form class="" method="post" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="box" style="width: 100%;">
                                            <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>">
                                            <label>ادخل المبلغ المراد شحن (دولار) </label>
                                            <input min="1" required type="number" id="sub_total" name="sub_total" class="form-control">
                                            <span class="sub_total" style="color: red;"></span>
                                        </div>
                                        <div id="paypal-button-container">
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <br>
    <br>
    <br><br>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> طلب سحب </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    <div class="box" style="width: 100%;">
                        <label> البريد الالكتروني (الباي بال ) </label>
                        <input required type="email" id="paypal_email" name="paypal_email" class="form-control">

                    </div>
                    <br>
                    <div class="box" style="width: 100%;">

                        <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>">
                        <label>ادخل المبلغ المراد سحبة (دولار) </label>
                        <input min="1" required type="number" id="withdraw_total" name="withdraw_total" class="form-control">
                        <p style="color:red"> اقل مبلغ سحب يكون 10 دولار </p>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="submit" class="btn btn-primary" name="with_draw_money"> سحب </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://www.paypal.com/sdk/js?client-id=Aa6xGlT7CdEYFS463meNhvyq6Tovq_rlYBK0U2pEMalXKRMy-1GxSFwAd6_UrMFQkaYxQRn-Dop6Gk61&currency=USD"></script>
<script>
    paypal.Buttons({
        onClick() {
            var subtotal = $("#sub_total").val();

            if (subtotal.length == 0) {
                $(".sub_total").text("* من فضلك ادخل المبلغ المراد شحنه ");

            } else {
                $(".sub_total").text("");

            }
            if (subtotal.length == 0) {
                return false;
            }
        },
        onCancel: function(data) {
            alert(" لم تكتمل عملية الدفع");

        },
        // Sets up the transaction when a payment button is clicked
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: $("#sub_total").val() // Can also reference a variable or function
                    }
                }]
            });
        },
        application_context: {
            shipping_preference: 'NO_SHIPPING'
        },
        // Finalize the transaction after payer approval
        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];

                var sub_total = $("#sub_total").val();
                var data = {
                    'sub_total': sub_total,
                    'payment_mode': 'pay with paypal',
                    'transaction_id': transaction.id
                }
                $.ajax({
                    method: "POST",
                    url: "charge_balance.php",
                    data: data,
                    datatype: "datatype",
                    success: function(response) {
                        if (response == 201) {
                            alert("Successess");
                            actions.redirect('http://localhost/hakum/balance');
                        }

                    },
                });
            });
        }
    }).render('#paypal-button-container');
</script>
<?php

include $tem . 'footer.php';
