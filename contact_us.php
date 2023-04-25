<?php
$page_title = ' هاكم - تواصل معنا ';
session_start();
include 'init.php';
?>

<!-- START HERO SECTION  -->

<div class="contact_page">
    <div class="container">
        <div class="data">
            <div class="row">
                <div class="col-6">
                    <div class="info">
                        <h2 class="animate__animated animate__fadeInUp animate__delay-0.3s"> تواصل معنا </h2>
                        <p> هاكم في خدمتك </p>
                    </div>
                </div>
                <div class="col-6">
                    <img src="uploads/contact.svg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END HERO SECTION  -->
<!-- START CONTACT_FORM SECTION -->
<div class="contact_form">
    <div class="container-fluid">
        <div class="data">
            <div class="row">
                <div class="col-lg-6">
                    <?php

                    if (isset($_POST['send_message'])) {
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $subject = $_POST['subject'];
                        $message = $_POST['message'];
                        $formerror = [];
                        if (empty($name)) {
                            $formerror[] = ' من فضلك ادخل الاسم  ';
                        }
                        if (empty($email)) {
                            $formerror[] = ' من فضلك ادخل البريد الالكتروني  ';
                        }
                        if (empty($message)) {
                            $formerror[] = ' من فضلك ادخل رسالتك   ';
                        }
                        if (empty($formerror)) {
                            $stmt = $connect->prepare("INSERT INTO contact_us (name, email, subject, message,time)
                            VALUE(:zname, :zemail, :zsub,:zmessage,:ztime)");
                            $stmt->execute(array(
                                "zname" => $name,
                                "zemail" => $email,
                                "zsub" => $subject,
                                "zmessage" => $message,
                                "ztime" => date('Y-m-d H:i:s')
                            ));
                            if ($stmt) {
                    ?>
                                <li class="alert alert-success"> تم ارسال رسالتك بنجاح , سوف نتواصل معك في اقرب وقت </li>
                            <?php
                            }
                        } else {
                            foreach ($formerror as $error) {
                            ?>
                                <li class="alert alert-danger"> <?php echo $error; ?> </li>
                    <?php
                            }
                        }
                    }
                    ?>
                    <div class="info">
                        <form action="#" method="post">
                            <div class="box">
                                <label for=""> الاسم <span class="star"> * </span></label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> البريد الالكتروني <span class="star"> * </span></label>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> عنوان الرسالة </label>
                                <input type="text" name="subject" id="subject" class="form-control">
                            </div>
                            <div class="box">
                                <label for=""> رسالتك <span class="star"> * </span></label>
                                <textarea name="message" id="message" class="form-control"></textarea>
                            </div>
                            <div class="box">
                                <button class="btn btn-primary" type="submit" name="send_message"> ارسال </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d950645.7063253215!2d39.77165849088825!3d21.450468423549314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15c3d01fb1137e59%3A0xe059579737b118db!2z2KzYr9ipINin2YTYs9i52YjYr9mK2Kk!5e0!3m2!1sar!2seg!4v1676466815283!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <!--
                <div class="col-lg-6">
                    <div class="info">
                        <div class="contact_info">
                            <i class="fa fa-envelope"></i>
                            <a href="#"> mr319242@gmail.com </a>
                        </div>
                        <div class="contact_info">
                            <i class="fa fa-phone"></i>
                            <a href="#"> 10111111111111 </a>
                        </div>
                        <div class="contact_info social_icon">
                            <ul class="list-unstyled">
                                <li> <a href="#">  <i class="fa fa-facebook"></i> </a>  </li>
                                <li> <a href="#">  <i class="fa fa-twitter"></i> </a>  </li>
                                <li> <a href="#">  <i class="fa fa-instagram"></i> </a>  </li>
                            </ul>
                        </div>
                    </div>
                </div>
-->
            </div>
        </div>
    </div>
</div>
<!--  END CONTACT FORM SECTION -->
<?php

include $tem . 'footer.php';
