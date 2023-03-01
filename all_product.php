<?php
$page_title = ' هاكم  - جميع الشحنات  ';
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
                                        <div class="control_setting_section active">
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
                                        <div class="control_setting_section">
                                            <i class="fa fa-dollar"></i>
                                            <p> الرصيد </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 travel">
                    <div class="slide2 data">
                        <div class="travel">
                            <div class="data">
                                <div class="row">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM products WHERE user_name = ?");
                                    $stmt->execute(array($_SESSION['username']));
                                    $allproduct = $stmt->fetchall();
                                    foreach ($allproduct as $product) {
                                    ?>
                                        <div class="col-lg-12">
                                            <div class=" travel_data">
                                                <div class="info">
                                                    <div class="product">
                                                        <img src="website_uploads/<?php echo $product['pro_image'] ?>" alt="">
                                                    </div>
                                                    <div class="product_info">
                                                        <p> <span> <img src="uploads/product_name.png" alt=""> اسم المنتج : </span> <?php echo $product['pro_name'] ?> </p>
                                                        <p> <span> <img src="uploads/from.png" alt=""> من : </span> <?php echo $product['pro_from'] ?> </p>
                                                        <p> <span> <img src="uploads/airport.png" alt=""> الي : </span> <?php echo $product['pro_to'] ?> </p>
                                                        <p> <span> <img src="uploads/timer.png" alt=""> تصل قبل : </span> <?php echo $product['arrieve_at'] ?> </p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <?php
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
</div>

<?php

include $tem . 'footer.php';
