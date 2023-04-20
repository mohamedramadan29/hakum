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
                            <?php
                            if ($userdata['profile_image'] != "") {
                            ?>
                                <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                            <?php
                            } else {
                            ?>
                                <img src="uploads/profile.png"> <?php
                                                            }
                                                                ?>
                            <h3> <?php echo $userdata['name']; ?> </h3>
                        </div>
                        <div class="control_setting">
                            <h6> لوحة التحكم </h6>
                            <br>
                            <div class="row">

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
                                        <div class="control_setting_section ">
                                            <i class="fa fa-plus"></i>
                                            <p> اضافة شحنة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="add_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plus"></i>
                                            <p> اضافة رحلة </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_product">
                                        <div class="control_setting_section">
                                            <i class="fa fa-book"></i>
                                            <p> شحناتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="all_travel">
                                        <div class="control_setting_section">
                                            <i class="fa fa-plane"></i>
                                            <p> رحلاتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="balance">
                                        <div class="control_setting_section">
                                            <i class="fa fa-dollar"></i>
                                            <p> الرصيد </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="deals">
                                        <div class="control_setting_section">
                                            <i class="fa fa-handshake"></i>
                                            <p> صفقاتي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="change_password">
                                        <div class="control_setting_section">
                                            <i class="fa fa-user-secret"></i>
                                            <p> كلمة المرور </p>
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

                            $address = $_POST['address'];
                            if (!empty($_FILES['passport']['name'])) {
                                $passport_name = $_FILES['passport']['name'];
                                $passport_temp = $_FILES['passport']['tmp_name'];
                                $passport_type = $_FILES['passport']['type'];
                                $passport_size = $_FILES['passport']['size'];
                                $passport_uploaded = time() . '_' . $passport_name;
                                move_uploaded_file(
                                    $passport_temp,
                                    'website_uploads/' . $passport_uploaded
                                );
                            } else {
                                $passport_uploaded = '';
                            }
                            if (!empty($_FILES['profile_image']['name'])) {
                                $profile_image_name = $_FILES['profile_image']['name'];
                                $profile_image_temp = $_FILES['profile_image']['tmp_name'];
                                $profile_image_type = $_FILES['profile_image']['type'];
                                $profile_image_size = $_FILES['profile_image']['size'];
                                $profile_image_uploaded = time() . '_' . $profile_image_name;
                                move_uploaded_file(
                                    $profile_image_temp,
                                    'website_uploads/' . $profile_image_uploaded
                                );
                            } else {
                                $profile_image_uploaded = '';
                            }
                            $formerror = [];

                            $stmt = $connect->prepare("SELECT * FROM users WHERE name !=? AND email =?");
                            $stmt->execute(array($_SESSION['username'], $email));
                            $data = $stmt->fetch();
                            $count = $stmt->rowCount();
                            if ($count > 0) {
                                $formerror[] = 'البريد الالكتروني مستخدم من قبل ';
                            }
                            if (empty($formerror)) {
                                $stmt = $connect->prepare('UPDATE users SET email=?,phone=?,birthday=?,address=? WHERE name=?');
                                $stmt->execute(array($email, $phone, $birthday, $address, $_SESSION['username']));
                                if (!empty($_FILES['passport']['tmp_name'])) {
                                    $stmt = $connect->prepare("UPDATE users SET passport=? WHERE name=?");
                                    $stmt->execute(array($passport_uploaded, $_SESSION['username']));
                                }
                                if (!empty($_FILES['profile_image']['tmp_name'])) {
                                    $stmt = $connect->prepare("UPDATE users SET profile_image=? WHERE name=?");
                                    $stmt->execute(array($profile_image_uploaded, $_SESSION['username']));
                                }
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
                            <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
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
                                    <label for=""> العنوان </label>
                                    <input type="text" name="address" id="address" class="form-control" value="<?php echo $userdata['address']; ?>">
                                </div>
                                <div class="box">
                                    <label for="">تاريخ الميلاد </label>
                                    <input type="text" name="birthday" id="birthday" class="form-control" value="<?php echo $userdata['birthday']; ?>">
                                </div> 
                                <div class="box">
                                    <label for=""> صورة جواز السفر </label>
                                    <input type="file" name="passport" id="phone" class="form-control" value="<?php echo $userdata['passport']; ?>">
                                </div>
                                <div class="box">
                                    <label for=""> صورة الملف الشخصي </label>
                                    <input type="file" name="profile_image" id="phone" class="form-control" value="<?php echo $userdata['profile_image']; ?>">
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
