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
            <a href="add_product" class="btn btn-primary"> اضف شحنة جديدة <i class="fa fa-address-book"></i> </a>

        </div>
        <div class="data">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="info">
                            <span class="fa fa-home"></span><input type="text" class="form-control" placeholder="من مدينة | دولة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <span class="fa fa-plane"></span><input type="text" class="form-control" placeholder="الي مدينة | دولة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <input type="date" class="form-control" placeholder=" توقيت الرحلة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <button class="btn btn-primary search_button"> بحث <i class="fa fa-search"></i> </button>
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
                                    <p> <span> <img src="uploads/product_name.png" alt=""> اسم المنتج : </span> <?php echo $product['pro_name'] ?>"</p>
                                    <p> <span> <img src="uploads/from.png" alt=""> من : </span> <?php echo $product['pro_from'] ?>" </p>
                                    <p> <span> <img src="uploads/airport.png" alt=""> الي : </span> <?php echo $product['pro_to'] ?>" </p>
                                    <p> <span> <img src="uploads/timer.png" alt=""> تصل قبل : </span> <?php echo $product['arrieve_at'] ?>"</p>
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
                                    <a href="#" class="button btn"> ارسل طلب </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } ?>
 
            </div>
        </div>
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
