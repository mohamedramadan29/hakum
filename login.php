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
                    <?php
                    if (isset($_POST['login'])) {
                        $name = $_POST['name'];
                        $password = $_POST['password'];

                        $formerror = [];
                        if (empty($name)) {
                            $formerror[] = ' من فضلك ادخل اسم المستخدم  ';
                        }
                        if (empty($password)) {
                            $formerror[] = ' من فضلك ادخل كلمة المرور ';
                        }
                        if (empty($formerror)) {
                            $stmt = $connect->prepare('SELECT * FROM users WHERE password=? AND (name=? OR email=?)');
                            $stmt->execute(array(sha1($password), $name, $name));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $_SESSION['username'] = $data['name'];
                                $_SESSION['userid'] = $data['user_id'];
                                // echo "Goood";
                                header('Location:profile');
                            } else {
                                $formerror[] = 'لا يوجد سجل بهذة البيانات';
                            }
                        } else { ?>
                            <ul>
                                <?php
                                foreach ($formerror as $error) {
                                ?>
                                    <li class="alert alert-danger"> <?php echo $error; ?> </li>
                                <?php
                                }
                                ?>
                            </ul>
                    <?php
                        }
                    }
                    ?>
                    <div class="login_form">
                        <h2> تسجيل دخول </h2>
                        <form action="" method="POST">
                            <div class="box">
                                <label for=""> اسم المستخدم او البريد الألكتروني</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> كلمة المرور </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="box">
                                <button class="btn btn-primary" name="login" type="submit"> تسجيل دخول </button>
                            </div>
                            <div class="box forget_box">
                                <label for="">
                                    <a href="register"> حساب جديد </a>
                                </label>
                                <label for="">
                                    <a href="forget_password"> نسيت كلمة المرور ؟ </a>
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
