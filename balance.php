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
                                        <div class="control_setting_section">
                                            <i class="fa fa-book"></i>
                                            <p> اضافة شحنة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="add_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plane"></i>
                                            <p> اضافة رحلة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_product">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plane"></i>
                                            <p> شحناتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-home"></i>
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
                            <div class="balance_show">
                                <a class="btn btn-primary" href="#"> شحن الرصيد </a>
                            </div>
                        </div>
                        <div class="add_balance">
                            <?php
                            if (isset($_POST['add_balance'])) {
                                $sub_total = filter_var($_POST['sub_total'], FILTER_SANITIZE_NUMBER_INT);
                                $forerror = [];
                                if (empty($sub_total)) {
                                    $forerror[] = 'من فضلك ادخل المبلغ المراد شحنة';
                                } else {

                                    $discount = $_POST['sub_total'] * 5 / 100;
                                    $total = $_POST['sub_total'] - $discount;
                                }
                                if (empty($forerror)) {
                                    $stmt = $connect->prepare("INSERT INTO balance_add (user_name, balance_subtotal,balance_discount ,balance_total) VALUES
                                    (:zusername, :zsubtotal, :zdiscount, :ztotal)");
                                    $stmt->execute(array(
                                        "zusername" => $_SESSION['username'],
                                        "zsubtotal" => $sub_total,
                                        "zdiscount" => $discount,
                                        "ztotal" => $total,
                                    ));
                                    
                                    $stmt = $connect->prepare("SELECT * FROM balance_add WHERE user_name=?");
                                    $stmt->execute(array($_SESSION['username']));
                                    $alldata = $stmt->fetchAll();
                                    $sum_total = 0;
                                    foreach($alldata as $data){
                                        $sum_total += $data['balance_total']; 
                                    }
                                    $stmt = $connect->prepare("UPDATE users SET balance=? WHERE name=?");
                                    $stmt->execute(array($sum_total, $_SESSION['username']));
                                    if ($stmt) {
                            ?>
                                        <div class="alert alert-success"> تم شحن الرصيد بنجاح </div>
                                    <?php
                                    }
                                } else {
                                    foreach ($forerror as $error) {
                                    ?>
                                        <div class="alert alert-danger"> <?php echo $error ?> </div>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <h6> شحن الرصيد </h6>
                            <form class="" method="post" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="box">
                                            <label>ادخل المبلغ المراد شحن (دولار) </label>
                                            <input min="1" required type="number" id="sub_total" name="sub_total" class="form-control" onchange="calc()">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box">
                                            <label> رسوم المنصة 5 % (دولار) </label>
                                            <input readonly required min="1" type="number" id="discount" name="discount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="box">
                                            <label> المبلغ المستحق بعد الرسوم (دولار) </label>
                                            <input readonly min="1" type="number" id="total" name="total" class="form-control">
                                        </div>
                                    </div>
                                    <div class="box">
                                        <input class="btn btn-primary" type="submit" name="add_balance" value="شحن الرصيد ">
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
