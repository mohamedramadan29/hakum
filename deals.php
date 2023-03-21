<?php
$page_title = ' هاكم  - حسابي ';
session_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}
// update notification
$stmt = $connect->prepare("UPDATE all_notification SET noti=1 WHERE noti_to=? AND noti_desc='بدء صفقة جديدة'");
$stmt->execute(array($_SESSION['username']));
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
                                <img src="uploads/profile.png"> <?php
                                                            }
                                                                ?>
                            <h3> <?php echo $userdata['name']; ?> </h3>
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
                                        <div class="control_setting_section">
                                            <i class="fa fa-dollar"></i>
                                            <p> الرصيد </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="deals">
                                        <div class="control_setting_section active">
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
                        <h3> الصفقات </h3>
                        <?php
                        $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE travel_owner=? OR product_owner=?");
                        $stmt->execute(array($_SESSION['username'], $_SESSION['username']));
                        $alldata = $stmt->fetchAll();
                        $count = $stmt->rowCount();
                        if ($count > 0) {
                            foreach ($alldata as $data) {
                                $stmt = $connect->prepare("SELECT * FROM travels WHERE travel_id=?");
                                $stmt->execute(array($data['travel_id']));
                                $travel = $stmt->fetch();
                        ?>
                                <div class="travel">
                                    <div class="data">
                                        <div class="travel_data">
                                            <div class="info">
                                                <div class="product">
                                                </div>
                                                <div class="product_info">
                                                    <p> <span> <img src="uploads/from.png" alt=""> من : </span>
                                                        <?php
                                                        $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                                        $stmt->execute(array($travel['travel_from_country']));
                                                        $country_data = $stmt->fetch();
                                                        $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                                        $stmt->execute(array($travel['travel_from_city']));
                                                        $city_data = $stmt->fetch();
                                                        echo $country_data['name'] . "-" . $city_data['name']
                                                        ?>
                                                    </p>
                                                    <p> <span> <img src="uploads/airport.png" alt=""> الي : </span>
                                                        <?php
                                                        $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                                        $stmt->execute(array($travel['travel_to_country']));
                                                        $country_data = $stmt->fetch();
                                                        $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                                        $stmt->execute(array($travel['travel_to_city']));
                                                        $city_data = $stmt->fetch();
                                                        echo $country_data['name'] . "-" . $city_data['name']  ?>
                                                    </p>
                                                    <p> <span> <img src="uploads/timer.png" alt=""> موعد الرحلة : </span> <?php echo $travel['travel_date'] ?> </p>
                                                    <p> <span> <img src="uploads/weight.png" alt=""> الوزن المتاح : </span> <?php echo $travel['av_weight'] ?> كجم </p>
                                                    <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span>
                                                        <?php
                                                        if ($data['status'] == 1) { ?>
                                                            <span class="bg bg-warning"> تحت التنفيذ </span>
                                                        <?php
                                                        } elseif ($data['status'] == 2) {
                                                        ?>
                                                            <span class="bg bg-info"> تمت </span>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <span class="bg bg-primary"> متاحة </span>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                    <p style="font-weight: bold;"> <span> <img src="uploads/dollar.png" alt=""> سعر الصفقة المتفقة علية : </span> <?php echo $data['sub_total'] ?> دولار </p>
                                                </div>
                                            </div>
                                            <div class="person_info">
                                                <div class="image_person">
                                                    <p> المسافر <span> : <?php echo $data['travel_owner']; ?> </span> </p>
                                                    <p> صاحب الشحنة <span> : <?php echo $data['product_owner']; ?> </span> </p>
                                                </div>
                                                <div class="send_request">
                                                    <?php
                                                    if (isset($_SESSION['username'])) {
                                                        if ($_SESSION['username'] === $data['travel_owner']) {
                                                    ?>
                                                            <a href="message?user=<?php echo $data['product_owner'] ?>&travel_id=<?php echo $data['travel_id']; ?>" class="button btn"> مناقشة الصفقة </a>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <a href="message?user=<?php echo $data['travel_owner'] ?>&travel_id=<?php echo $data['travel_id']; ?>" class="button btn"> مناقشة الصفقة </a>
                                                    <?php
                                                        }
                                                    }  ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <div class="alert alert-success"> لا يوجد لديك صفقات في الوقت الحالي </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include $tem . 'footer.php';
