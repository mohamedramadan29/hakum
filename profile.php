<?php
$page_title = ' هاكم  - حسابي ';
session_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}

$stmt = $connect->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute(array($_SESSION['username']));
$userdata = $stmt->fetch();
?>
<div class="profile">
    <div class="container-fluid">
        <div class="data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="slide1">
                        <div class="personal_image">
                            <img src="uploads/profile.png" alt="">
                            <h3> <?php echo $userdata['name']; ?> </h3>
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
                                        <div class="control_setting_section active">
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
                        <?php 
                        if (isset($_POST['save_change'])) {
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $birthday = $_POST['birthday'];
                            $formerror = [];
                            /*
                            $stmt = $connect->prepare("SELECT * FROM users WHERE name !=? AND email =?");
                            $stmt->execute(array($_SESSION['username'], $email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            echo $count;
                            if ($count > 0) {
                                $formerror[] = 'البريد الالكتروني مستخدم من قبل ';
                            }*/
                            if (empty($formerror)) {
                                $stmt = $connect->prepare('UPDATE users SET email=?,phone=?,birthday=?');
                                $stmt->execute(array($email, $phone, $birthday));
                                if ($stmt) {
                        ?>
                                    <div class="alert alert-success"> تم تعديل البيانات بنجاح </div>
                                <?php
                                }
                            } else {
                                foreach ($formerror as $error) { ?>
                                    <li class="alert alert-danger"> <?php echo $error; ?> </li>
                        <?php
                                }
                            }
                        }
                        ?>
                        <div class="my_form">
                            <form action="" method="post">
                                <div class="box">
                                    <label for=""> اسم المستخدم </label>
                                    <input disabled type="text" name="name" id="name" class="form-control" value="<?php echo $userdata['name']; ?>">
                                </div>
                                <div class="box">
                                    <label for=""> البريد الالكتروني </label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo $userdata['email']; ?>">
                                </div>
                                <div class="box">
                                    <label for=""> رقم الهاتف </label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo $userdata['phone']; ?>">
                                </div>
                                <div class="box">
                                    <label for="">تاريخ الميلاد </label>
                                    <input type="text" name="birthday" id="birthday" class="form-control" value="<?php echo $userdata['birthday']; ?>">
                                </div>
                                <div class="box">
                                    <input type="submit" class="btn btn-primary" name="save_change" value=" حفظ التغيرات ">

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
