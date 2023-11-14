<?php
$page_title = ' هاكم -  نسيت كلمة المرور   ';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'init.php';
?>
<div class="login_page">
    <div class="container">
        <div class="data">
            <div class="row">
                <div class="col-lg-6">
                    <?php

                    $length = 8; // Set the length of the random string
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Set the characters to use
                    $randomString = '';

                    // Generate the random string
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, strlen($characters) - 1)];
                    }
                    $randomString =  substr($randomString, 0, 8);
                    ?>
                    <?php
                    if (isset($_POST['forget_password'])) {
                        $username_email = $_POST['username_email'];
                        $formerror = [];
                        if (empty($username_email)) {
                            $formerror[] = ' من فضلك ادخل اسم المستخدم او البريد الالكتروني  ';
                        }
                        if (empty($formerror)) {
                            $stmt = $connect->prepare('SELECT * FROM users WHERE name=? OR email=?');
                            $stmt->execute(array($username_email, $username_email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $stmt = $connect->prepare("UPDATE users SET pass_code=?, password=? WHERE name=?");
                                $stmt->execute(array($randomString, sha1($randomString), $data['name']));
                                $to_email = $data['email'];
                                $to_name = $data['name'];
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
                                    $mail->addAddress($to_email, $to_name);
                                    $mail->Subject = ' تعديل كلمة المرور ';
                                    $mail->Body = " <p style='font-size:18px; font-family:inherit'>مرحبا " . $to_name . ",</p>
                                                    <p style='font-size:18px; font-family:inherit'> كلمة المرور الجديدة الخاصة بك هي  .</p>
                                                     
                                                    <p><strong>" . $randomString . "</strong></p>
                                            ";
                                    $mail->AltBody = 'This is the plain text message body for non-HTML mail clients.';
                                    // إرسال البريد الإلكتروني
                                    $mail->send();
                                } catch (Exception $e) {
                                    echo "حدث خطأ في إرسال البريد الإلكتروني: {$mail->ErrorInfo}";
                                }
                                // $subject = "   طلب استعادة كلمة المرور من منصة هاكم  ";
                                // $body =   " كلمة المورو الجديدة الخاصة بك هي   ";
                                // $body .= " =>  " . $randomString;
                                // $headers = "From: info@haackum.com";
                                // mail($to_email, $subject, $body, $headers);
                                if ($stmt) {
                    ?>
                                    <li class="alert alert-success"> تم ارسال كلمة المرور الجديدة علي الايميل الخاص بك ( <?php echo $data['email']; ?> ) </li>

                                <?php
                                    header('refresh:4;url=login');
                                }
                            } else { ?>
                                <li class="alert alert-danger"> لا يوجد سجل بهذة البيانات </li>
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
                        <h2> استعادة كلمة المرور </h2>
                        <form action="" method="POST">
                            <div class="box">
                                <label for=""> اسم المستخدم او البريد الالكتروني </label>
                                <input required type="text" name="username_email" id="username_email" class="form-control" value="<?php if (isset($_REQUEST['username_email'])) echo $_REQUEST['username_email'] ?>" class="form-control">
                            </div>
                            <div class="box">
                                <button class="btn btn-primary" name="forget_password" type="submit"> تاكيد </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="uploads/forget.svg" alt="">
                </div>
            </div>

        </div>
    </div>
</div>
<?php

include $tem . 'footer.php';
