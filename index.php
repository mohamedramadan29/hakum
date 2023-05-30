<?php
$page_title = ' هاكم ';
session_start();
include 'init.php';
?>
<!-- START HERO SECTION  -->
<div class="hero">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <div class="row">
                    <div class="col-12">
                        <div class="info">
                            <h2> هاكم </h2>
                            <p class="animate__animated animate__fadeInUp animate__delay-0.6s"> منصة لوجستية تربط بين المرسلين لمستنداتهم </br> والمسافرين بجمعهم في منصة واحدة ، بسعر أفضل ووقت أقصر</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HERO SECTION  -->


<!-- START HOW WORK  -->
<div class="how_work">
    <div class="container">
        <div class="data">
            <h2> كيف نعمل </h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="info">
                        <span> <img src="uploads/product.png" alt=""> </span>
                        <h4> أضف شحنة </h4>
                        <p> ضع معلومات الشحنة التي تريد ارسالها ،وسيأتيك عروض الرحلات الأقرب لهدفك </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info">
                    <span> <img src="uploads/world.png" alt=""> </span>
                        <h4> أضف رحلة </h4>
                        <p> ضع معلومات رحلتك ،ومقدار الوزن المتاح ،وستأتيك عروض الشحنات التي تناسبك ... </p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="info">
                    <span> <img src="uploads/delivery.png" alt=""> </span>
                        <h4> التوصيل </h4>
                        <p> سنوفر لك الدعم التام والمباشر لايصال شحناتك من خلال ربطك بأقرب الرحلات المتوفرة </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HOW WORK  -->
<!-- START LATEST TRAVEL  -->
<div class="travel" style="background-color:#fff">
    <div class="container-fluid">
        <div class="data">
            <h2> احدث الطلبات </h2>
            <div class="row">
                <?php
                $stmt = $connect->prepare("SELECT * FROM products");
                $stmt->execute();
                $allproduct = $stmt->fetchall();
                foreach ($allproduct as $product) { ?>
                    <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-0.3s">
                        <div class="travel_data">
                            <div class="info">
                                <div class="product">
                                    <img src="website_uploads/<?php echo $product['pro_image'] ?>" alt="">
                                </div>
                                <div class="product_info">
                                    <p> <span> <img src="uploads/product_name.png" alt=""> اسم المنتج : </span> <?php echo $product['pro_name'] ?></p>
                                    <p> <span> <img src="uploads/from.png" alt=""> من : </span> <?php
                                                                                                $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                                                                                $stmt->execute(array($product['pro_from_country']));
                                                                                                $country_data = $stmt->fetch();
                                                                                                $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                                                                                $stmt->execute(array($product['pro_from_city']));
                                                                                                $city_data = $stmt->fetch();
                                                                                                echo $country_data['name'] . "-" . $city_data['name']  ?> </p>
                                    <p> <span> <img src="uploads/airport.png" alt=""> الي : </span>
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                        $stmt->execute(array($product['pro_to_country']));
                                        $country_data = $stmt->fetch();
                                        $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                        $stmt->execute(array($product['pro_to_city']));
                                        $city_data = $stmt->fetch();
                                        echo $country_data['name'] . "-" . $city_data['name']  ?> </p>
                                    <p> <span> <img src="uploads/timer.png" alt=""> تصل قبل : </span> <?php echo $product['arrieve_at'] ?></p>
                                </div>
                            </div>
                            <div class="person_info">
                                <div class="image_person">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                                    $stmt->execute(array($product['user_name']));
                                    $userdata = $stmt->fetch();
                                    if ($userdata['profile_image'] != "") {
                                    ?>
                                        <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="uploads/avatar.gif" alt="">
                                    <?php
                                    }
                                    ?>
                                    <p> <?php echo $product['user_name'] ?> </p>
                                </div>
                                <div class="send_request">
                                    <a href="#" class="button btn"> التفاصيل وارسال طلب </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } ?>

            </div>
            <a href="products" class="btn btn-primary all_button"> جميع الطلبات <i class="fa fa-address-book"></i> </a>
        </div>
    </div>
</div>
<!-- END LATEST TRAVEL  -->


<!-- START LATEST TRAVEL  -->
<div class="travel">
    <div class="container-fluid">
        <div class="data">
            <h2> احدث الرحلات </h2>
            <div class="row">
                <?php
                $stmt = $connect->prepare("SELECT * FROM travels");
                $stmt->execute();
                $alltravel = $stmt->fetchall();
                foreach ($alltravel as $travel) { ?>
                    <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-0.3s">
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
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE travel_id = ?");
                                    $stmt->execute(array($travel['travel_id']));
                                    $deal_data = $stmt->fetch();
                                    $count_deal = $stmt->rowCount();
                                    if ($count_deal > 0) {
                                        if ($deal_data['status'] == 1) { ?>
                                            <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> تحت التنفيذ </p>
                                        <?php
                                        } elseif ($deal_data['status'] == 2) { ?>
                                            <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> تمت </p>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> متاح </p>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="person_info">
                                <div class="image_person">
                                    <?php
                                    $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                                    $stmt->execute(array($travel['user_name']));
                                    $userdata = $stmt->fetch();
                                    if ($userdata['profile_image'] != "") {
                                    ?>
                                        <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="uploads/avatar.gif" alt="">
                                    <?php
                                    }
                                    ?>

                                    <p> <?php echo $travel['user_name'] ?> </p>
                                </div>
                                <div class="send_request">
                                    <?php
                                    if (isset($_SESSION['username'])) {
                                        if ($_SESSION['username'] === $travel['user_name']) {
                                    ?>
                                            <a href="all_travel" class="button btn"> تفاصيل الرحلة </a>
                                        <?php
                                        } else {
                                        ?>
                                            <a href="message?user=<?php echo $travel['user_name'] ?>&travel_id=<?php echo $travel['travel_id']; ?>" class="button btn"> التفاصيل وارسال طلب </a>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="login" class="button btn"> التفاصيل وارسال طلب </a>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php

                }
                ?>
            </div>
            <a href="travels" class="btn btn-primary all_button"> جميع الرحلات <i class="fa fa-plane"></i> </a>
        </div>
    </div>
</div>
<!-- END LATEST TRAVEL  -->
<div class="register_now">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> سجل الان في هاكم </h2>
                <p> نعمل على توفير الحلول التشاركية في النقل بين الأفراد لتحصيل المنافع المشتركة
                </p>
                <a href="register" class="button btn"> سجل الان </a>
            </div>
        </div>
    </div>
</div>
<?php

include $tem . 'footer.php';
