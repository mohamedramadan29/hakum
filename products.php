<?php
$page_title = ' هاكم - الشحنات  ';
session_start();
include 'init.php';
?>
<!-- START HERO SECTION  -->
<div class="form_search">
    <div class="container-fluid">
        <div class="travel_head">
            <h2> جميع الشحنات </h2>
            <a href="add_product" class="btn btn-primary"> اضف شحنة جديدة <i class="fa fa-plane"></i> </a>
        </div>
        <div class="data">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="info2">
                            <!-- <input type="text" class="form-control" placeholder=" مكان المغادرة  "> -->
                            <select name="product_from_country" id="" class="form-control select2">
                                <option value=""> -- اختر مكان المغادرة --</option>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM countries");
                                $stmt->execute();
                                $allcountry = $stmt->fetchAll();
                                foreach ($allcountry as $country) {
                                ?>
                                    <option <?php if (isset($_REQUEST['product_from_country']) && ($_REQUEST['product_from_country'] == $country['id'])) echo 'selected'; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="info2">
                            <!-- <input type="text" class="form-control" placeholder=" مكان المغادرة  "> -->
                            <select name="product_to_country" id="" class="form-control select2">
                                <option value=""> -- اختر مكان الوصول --</option>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM countries");
                                $stmt->execute();
                                $allcountry = $stmt->fetchAll();
                                foreach ($allcountry as $country) {
                                ?>
                                    <option <?php if (isset($_REQUEST['product_to_country']) && ($_REQUEST['product_to_country'] == $country['id'])) echo 'selected'; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="info">
                            <button type="submit" class="btn btn-primary search_button" name="search_button"> بحث <i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END HERO SECTION  -->
<!-- START LATEST TRAVEL  -->
<div class="travel travel_page">
    <div class="container-fluid">
        <div class="data">
            <?php
            if (isset($_POST['search_button'])) {
                $product_from = $_POST['product_from_country'];
                $product_to = $_POST['product_to_country'];
                if ($product_from == '' && $product_to == '') {
                    $stmt = $connect->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($product_from != '') {
                    $stmt = $connect->prepare("SELECT * FROM products WHERE pro_from_country=?");
                    $stmt->execute(array($product_from));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($product_to != '') {
                    $stmt = $connect->prepare("SELECT * FROM products WHERE pro_to_country=?");
                    $stmt->execute(array($product_to));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($product_from != '' && $product_to != '') {
                    $stmt = $connect->prepare("SELECT * FROM products WHERE pro_from_country=? AND pro_to_country=?");
                    $stmt->execute(array($product_from, $product_to));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } else {
                    $stmt = $connect->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                }
            } else {
                $stmt = $connect->prepare("SELECT * FROM products");
                $stmt->execute();
                $alltravel = $stmt->fetchall();
                $count = $stmt->rowCount();
            ?>

            <?php
            }
            ?>
            <?php
            if ($count > 0) {
            ?>
                <div class="row">
                    <?php
                    $stmt = $connect->prepare("SELECT * FROM products");
                    $stmt->execute();
                    $allproduct = $stmt->fetchall();
                    foreach ($allproduct as $product) { ?>
                        <div class="col-lg-6 animate__animated animate__fadeInUp animate__delay-0.3s">
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
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                            if ($_SESSION['username'] === $product['user_name']) {
                                        ?>
                                                <a href="all_product" class="button btn"> تفاصيل الشحنة </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="pro_message?user=<?php echo $product['user_name'] ?>&pro_id=<?php echo $product['pro_id']; ?>" class="button btn"> التفاصيل وارسال طلب </a>
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
                    } ?>

                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-info"> لا يوجد بيانات !! </div>
            <?php
            }
            ?>
        </div>
        <!--
        <div class="pagin">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">السابق</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">التالي </a>
                    </li>
                </ul>
            </nav>
        </div>
            -->
    </div>
</div>
<!-- END LATEST TRAVEL  -->
<div class="register_now">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> سجل الان في هاكم </h2>
                <p> التوصيل السريع الامن أثناء السفر </p>
                <a href="#" class="button btn"> سجل الان </a>
            </div>
        </div>
    </div>
</div>
<?php

include $tem . 'footer.php';
