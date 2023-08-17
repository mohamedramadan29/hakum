<?php
ob_start();
$page_title = ' هاكم -    حساب جديد ';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include 'init.php';
if (isset($_SESSION['username'])) {
    header('Location:profile');
}
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
                        if (strlen($password) < 8) {
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
                            
                            // Generate a unique activation code
                            $activationCode = md5(uniqid(rand(), true));
                            $stmt = $connect->prepare("INSERT INTO users (name,email,password,active_status_code)
                            VALUES (:zname,:zemail,:zpassword,:zstatus_code)");
                            $stmt->execute(array(
                                'zname' => $name,
                                'zemail' => $email,
                                'zpassword' => $password,
                                'zstatus_code' => $activationCode,
                            ));
                            if ($stmt) {
                                // START SEND MAIL ////////////////////////////////////
                                //Create an instance; passing `true` enables exceptions
                                $mail = new PHPMailer(true);
                                try {
                                    // الإعدادات الأساسية لإعداد البريد الإلكتروني
                                    $mail->CharSet = 'UTF-8';
                                    $mail->WordWrap = true;
                                    $mail->isSMTP();
                                    $mail->Host = 'haackum.com';
                                    $mail->SMTPAuth = true;
                                    $mail->Username = 'info@haackum.com';
                                    $mail->Password = 'mohamedramadan2930';
                                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                    //To load the French version
                                    // $mail->setLanguage('ar');
                                    $mail->Port = 587;

                                    // مُحتوى الرسالة

                                    $mail->setFrom('info@haackum.com', 'هاكم ');
                                    $mail->addAddress($email, $name);
                                    $mail->Subject = 'تفعيل الحساب الخاص بك  ';
                                    $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $name . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'>شكرا لك على تسجيلك في هاكم .</p>
                                                    <p style='font-size:18px; font-family:inherit'>كود التفعيل الخاص بك هو:</p>
                                                    <p><strong>" . $activationCode . "</strong></p>
                                            ";
                                    $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';

                                    // إرسال البريد الإلكتروني
                                    $mail->send();
                                    $_SESSION['mail'] = $email;
                                    header('Location:activate');
                                } catch (Exception $e) {
                                    echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                                }
                                // END SEND MAIL //////////////////////////////////////

                    ?>
                                <div class="alert alert-success"> راائع , تم عمل الحساب بنجاح سجل دخولك الان </div>
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
                        <form action="#" method="post">
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
                                <span onclick="togglePasswordVisibility()" class="fa fa-eye password_show_icon"></span>
                            </div>
                            <div class="box">
                                <label for=""> اعادة كلمة المرور </label>
                                <input required type="password" name="confirm_password" id="confirm_password" class="form-control">
                            </div>
                            <div class="box">
                                <div class="input_box">
                                    <div class="form-check">
                                        <input checked class="form-check-input" type="checkbox" value="" id="flexCheckChecked" style=" height: 16px !important;">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            أوفق علي <a href="privacy_policy" target="_blank" style="color: var(--second-color); text-decoration: none;"> شروط الاستخدام </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="box forget_box">
                                <div class="box">
                                    <button name="new_account" class="btn btn-primary"> حساب جديد </button>
                                </div>

                                <label for="">
                                    <a href="login"> تسجيل دخول ! </a>
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
?>
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordIcon = document.querySelector(".password_show_icon");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordIcon.classList.add("password_show_icon_active");
        } else {
            passwordInput.type = "password";
            passwordIcon.classList.remove("password_show_icon_active");
        }
    }
</script>