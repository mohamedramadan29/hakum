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
                    <?php
                    if (isset($_POST['new_account'])) {

                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $password = sha1($_POST['password']);
                        $confirm_password = sha1($_POST['confirm_password']);
                        $formerror = [];
                        if (empty($name)) {
                            $formerror[] = ' من فضلك ادخل اسم المستخدم  ';
                        }
                        if (empty($email)) {
                            $formerror[] = 'من فضلك ادخل البريد الالكتروني ';
                        }
                        if (strlen($password < 8)) {
                            $formerror[] = 'كلمة المرور يجب ان تكون اكثر من 8 احرف ';
                        }
                        if ($password !== $confirm_password) {
                            $formerror[] = 'يجب تاكيد كلمة المرور بالشكل الصحيح';
                        }
                        $stmt = $connect->prepare('SELECT * FROM users WHERE email=?');
                        $stmt->execute(array($email));
                        $count = $stmt->rowcount();
                        if ($count > 0) {
                            $formerror[] = 'البريد الالكتروني مستخدم من قبل ';
                        }
                        $stmt = $connect->prepare('SELECT * FROM users WHERE name=?');
                        $stmt->execute(array($name));
                        $count = $stmt->rowcount();
                        if ($count > 0) {
                            $formerror[] = ' اسم المستخدم مستخدم من قبل  ';
                        }

                        if (empty($formerror)) {
                            $stmt = $connect->prepare("INSERT INTO users (name,email,password)
                            VALUES (:zname,:zemail,:zpassword)");
                            $stmt->execute(array(
                                'zname' => $name,
                                'zemail' => $email,
                                'zpassword' => $password
                            ));
                            if ($stmt) {
                    ?>
                                <div class="alert alert-suceess"> راائع , تم عمل الحساب بنجاح سجل دخولك الان </div>
                            <?php
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
                        <h2> حساب جديد </h2>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <div class="box">
                                <label for=""> اسم المستخدم </label>
                                <input required type="text" name="name" id="name" value="<?php if (isset($_REQUEST['name'])) echo $_REQUEST['name'] ?>" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> البريد الالكتروني </label>
                                <input required type="email" name="email" id="email" value="<?php if (isset($_REQUEST['email'])) echo $_REQUEST['email'] ?>" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> كلمة المرور </label>
                                <input required type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> اعادة كلمة المرور </label>
                                <input required type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <div class="box">
                                <button name="new_account" class="btn btn-primary"> حساب جديد </button>
                            </div>
                            <div class="box forget_box">
                                <label for="">
                                    <a href="login"> تسجيل دخول </a>
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
