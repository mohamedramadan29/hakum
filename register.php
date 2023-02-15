<?php
$page_title = ' هاكم -    حساب جديد ';
session_start();
include 'init.php';
?>
<div class="login_page">
    <div class="container">
        <div class="data">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login_form">
                        <h2>  حساب جديد   </h2>
                        <form action="">
                            <div class="box">
                                <label for=""> اسم المستخدم </label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> البريد الالكتروني </label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> كلمة المرور </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> اعادة كلمة المرور </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="box">
                                <button class="btn btn-primary"> تسجيل دخول  </button>
                            </div>
                            <div class="box forget_box">
                                <label for="">
                                <a href="login">  تسجيل دخول  </a> 
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="uploads/register.svg" alt="">
                </div>
            </div>

        </div>
    </div>
</div>
<?php

include $tem . 'footer.php';
