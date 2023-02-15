<?php
$page_title = ' هاكم  - حسابي ';
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
                                        <div class="control_setting_section active">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="slide2">
                        <div class="my_form">
                            <form action="" method="">
                                <div class="box">
                                    <label for=""> اسم المنتج </label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="box">
                                    <label for=""> مكان المغادرة </label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="box">
                                    <label for=""> مكان الوصول </label>
                                    <input type="text" name="username" id="username" class="form-control">
                                </div>
                                <div class="box">
                                    <label for=""> موعد الوصول المتوقع </label>
                                    <input type="date" name="username" id="username" class="form-control">
                                </div>
                                <div class="box">
                                    <label for=""> صورة المنتج </label>
                                    <input type="file" name="username" id="username" class="form-control">
                                </div>
                                <div class="box">
                                    <button type="submit" class="btn btn-primary"> اضافة شحنة </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

include $tem . 'footer.php';
