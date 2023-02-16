<?php
$page_title = ' هاكم  - جميع الشحنات  ';
session_start();
include 'init.php';
?>
<div class="profile">
    <div class="container-fluid">
        <div class="data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="slide1">
                        <div class="personal_image">
                            <img src="uploads/profile.png" alt="">
                            <h3> Mohamed Ramadan </h3>
                        </div>
                        <div class="control_setting">
                            <h6> لوحة التحكم </h6>
                            <div class="row">
                                <div class="col-4">
                                    <div class="control_setting_section ">
                                        <i class="fa fa-home"></i>
                                        <p> الرئيسية </p>
                                    </div>
                                </div>
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
                                        <div class="control_setting_section active">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 travel">
                    <div class="slide2 data">
                        <div class="travel">
                            <div class="data">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class=" travel_data">
                                            <div class="info">
                                                <div class="product">
                                                    <img src="uploads/product.jpg" alt="">
                                                </div>
                                                <div class="product_info">
                                                    <p> <span> <img src="uploads/product_name.png" alt=""> اسم المنتج : </span> اوراق شخصية </p>
                                                    <p> <span> <img src="uploads/from.png" alt=""> من : </span> القاهرة </p>
                                                    <p> <span> <img src="uploads/airport.png" alt=""> الي : </span> الاسكندرية </p>
                                                    <p> <span> <img src="uploads/timer.png" alt=""> تصل قبل : </span> 12 سبتمر 2023 </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class=" travel_data">
                                            <div class="info">
                                                <div class="product">
                                                    <img src="uploads/product.jpg" alt="">
                                                </div>
                                                <div class="product_info">
                                                    <p> <span> <img src="uploads/product_name.png" alt=""> اسم المنتج : </span> اوراق شخصية </p>
                                                    <p> <span> <img src="uploads/from.png" alt=""> من : </span> القاهرة </p>
                                                    <p> <span> <img src="uploads/airport.png" alt=""> الي : </span> الاسكندرية </p>
                                                    <p> <span> <img src="uploads/timer.png" alt=""> تصل قبل : </span> 12 سبتمر 2023 </p>
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
        </div>
    </div>
</div>

<?php

include $tem . 'footer.php';
