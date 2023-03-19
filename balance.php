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
                                            <p> صفقاتي  </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="slide2">
                        <div class="balance_section">
                            <div class="balance_num">
                                <h3> الرصيد الكلي </h3>

                                <span> <?php echo $userdata['balance']; ?> دولار </span>
                            </div>

                        </div>
                        <div class="add_balance">
                            <h6> شحن الرصيد </h6>
                            <form class="" method="post" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="box">
                                            <input type="hidden" name="user_name" value="<?php echo $_SESSION['username']; ?>">
                                            <label>ادخل المبلغ المراد شحن (دولار) </label>
                                            <input min="1" required type="number" id="sub_total" name="sub_total" class="form-control">
                                            <span class="sub_total" style="color: red;"></span>
                                        </div>
                                    </div>
                                    <div id="paypal-button-container">
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
