<?php
$page_title = ' هاكم  - جميع الرحلات  ';
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
                                        <div class="control_setting_section active">
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
                <div class="col-lg-8 travel">
                    <div class="slide2 data">
                        <div class="travel">
                            <div class="data">
                                <div class="row">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM travels WHERE user_name = ?");
                                    $stmt->execute(array($_SESSION['username']));
                                    $alltravel = $stmt->fetchall();
                                    $count = $stmt->rowCount();
                                    if ($count > 0) {
                                        foreach ($alltravel as $travel) { ?>
                                            <div class="col-lg-12">
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
                                                                ?></p>
                                                            <p> <span> <img src="uploads/airport.png" alt=""> الي : </span>
                                                                <?php
                                                                $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                                                $stmt->execute(array($travel['travel_to_country']));
                                                                $country_data = $stmt->fetch();
                                                                $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                                                $stmt->execute(array($travel['travel_to_city']));
                                                                $city_data = $stmt->fetch();
                                                                echo $country_data['name'] . "-" . $city_data['name']  ?> </p>
                                                            <p> <span> <img src="uploads/timer.png" alt=""> موعد الرحلة : </span> <?php echo $travel['travel_date'] ?> </p>
                                                            <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> متاح </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-success"> لا يوجد لديك رحلات في الوقت الحالي </div>
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
</div>

<?php

include $tem . 'footer.php';
