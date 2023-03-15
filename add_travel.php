<?php
$page_title = ' هاكم  - اضافة رحلة  ';
session_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}

$stmt = $connect->prepare("SELECT * FROM users WHERE name = ?");
$stmt->execute(array($_SESSION['username']));
$userdata = $stmt->fetch();
$user_id = $userdata['user_id'];
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
                                        <div class="control_setting_section">
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
                                        <div class="control_setting_section active">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="slide2">
                        <?php

                        if (isset($_POST['add_travel'])) {
                            $travel_from = $_POST['travel_from'];
                            $travel_to = $_POST['travel_to'];
                            $travel_date = $_POST['travel_date'];
                            $travel_arrive_date = $_POST['travel_arrive_date'];
                            $av_weight = $_POST['av_weight'];

                            $errors = [];
                            if (empty($travel_from) || empty($travel_to) || empty($travel_date) || empty($travel_arrive_date) || empty($av_weight)) {
                                $errors[] = 'من فضلك ادخل المعلومات كاملة ';
                            }
                            if (empty($errors)) {
                                $stmt = $connect->prepare("INSERT INTO travels (travel_from,travel_to,travel_date,travel_arrive_date,av_weight,user_name,user_id)
                                VALUES(:zfrom,:zto,:ztravel_date,:ztravel_arrive,:zav_weight,:zuser_name,:zuser_id)");
                                $stmt->execute(array(
                                    'zfrom' => $travel_from,
                                    'zto' => $travel_to,
                                    'ztravel_date' => $travel_date,
                                    'ztravel_arrive' => $travel_arrive_date,
                                    'zav_weight' => $av_weight,
                                    'zuser_name' => $_SESSION['username'],
                                    'zuser_id' => $user_id,
                                ));
                                if ($stmt) {
                        ?>
                                    <li class="alert alert-success"> تم اضافة الرحلة بنجاح </li>
                                <?php
                                }
                            } else {
                                foreach ($errors as $error) {
                                ?>
                                    <li class="alert alert-danger"> <?php echo $error; ?> </li>
                        <?php
                                }
                            }
                        }

                        ?>
                        <div class="my_form">
                            <form action="" method="post" enctype="multipart/form-data">

                                <div class="box">
                                    <label for=""> مكان المغادرة </label>
                                    <input type="text" name="travel_from" id="travel_from" class="form-control" value="<?php if (isset($_REQUEST['travel_from'])) echo $_REQUEST['travel_from'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> مكان الوصول </label>
                                    <input type="text" name="travel_to" id="travel_to" class="form-control" value="<?php if (isset($_REQUEST['travel_to'])) echo $_REQUEST['travel_to'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> توقيت الرحلة </label>
                                    <input type="date" name="travel_date" id="travel_date" class="form-control" value="<?php if (isset($_REQUEST['travel_date'])) echo $_REQUEST['travel_date'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> توقيت الوصول المتوقع </label>
                                    <input type="date" name="travel_arrive_date" id="travel_arrive_date" class="form-control" value="<?php if (isset($_REQUEST['travel_arrive_date'])) echo $_REQUEST['travel_arrive_date'] ?>">
                                </div>
                                <div class="box">
                                    <label for="">  الوزن المتاح (كجم) </label>
                                    <input type="number" name="av_weight" id="av_weight" class="form-control" value="<?php if (isset($_REQUEST['av_weight'])) echo $_REQUEST['av_weight'] ?>">
                                </div>
                                <div class="box">
                                    <input type="submit" name="add_travel" class="btn btn-primary" value=" اضافة رحلة ">
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
