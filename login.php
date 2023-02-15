<?php
$page_title = ' هاكم - تسجيل دخول ';
session_start();
include 'init.php';
?>
<div class="login_page">
    <div class="container">
        <div class="data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_form">
                        <h2> تسجيل دخول </h2>
                        <form action="">
                            <div class="box">
                                <label for=""> اسم المستخدم </label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> كلمة المرور </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                        
                            <div class="box">
                                <button class="btn btn-primary"> تسجيل دخول  </button>
                            </div>
                            <div class="box forget_box">
                                <label for="">
                                <a href="register">  حساب جديد  </a> 
                                </label>
                                <label for="">
                                <a href="register">    نسيت كلمة المرور ؟  </a> 
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="uploads/login.png" alt="">
                </div>
            </div>

        </div>
    </div>
</div>
<?php

include $tem . 'footer.php';
