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
                            $travel_from_country = $_POST['travel_from_country'];
                            $travel_from_city = $_POST['travel_from_city'];
                            $travel_to_country = $_POST['travel_to_country'];
                            $travel_to_city = $_POST['travel_to_city'];
                            $travel_date = $_POST['travel_date'];
                            $travel_arrive_date = $_POST['travel_arrive_date'];
                            $av_weight = $_POST['av_weight'];

                            $errors = [];
                            if (empty($travel_from_country) || empty($travel_to_country) || empty($travel_date) || empty($travel_arrive_date) || empty($av_weight)) {
                                $errors[] = 'من فضلك ادخل المعلومات كاملة ';
                            }
                            if (empty($errors)) {
                                $stmt = $connect->prepare("INSERT INTO travels (travel_from_country,travel_from_city,travel_to_country,travel_to_city,travel_date,travel_arrive_date,av_weight,user_name,user_id)
                                VALUES(:zfrom_country,:zfrom_city,:zto_country,:zto_city,:ztravel_date,:ztravel_arrive,:zav_weight,:zuser_name,:zuser_id)");
                                $stmt->execute(array(
                                    'zfrom_country' => $travel_from_country,
                                    'zfrom_city' => $travel_from_city,
                                    'zto_country' => $travel_to_country,
                                    'zto_city' => $travel_to_city,
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
                                    <div class="pro_from">
                                        <div>
                                            <select name="travel_from_country" id="pro_form_country" class="form-control select2">
                                                <option value=""> -- اختر الدولة --</option>
                                                <?php
                                                $stmt = $connect->prepare("SELECT * FROM countries");
                                                $stmt->execute();
                                                $allcountry = $stmt->fetchAll();
                                                foreach ($allcountry as $country) {
                                                ?>
                                                    <option value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                            <select name="travel_from_city" class="form-control select2" id="pro_from_city">
                                                <option value=""> -- اختر المدينة -- </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="box">
                                    <label for=""> مكان الوصول </label>
                                    <div class="pro_from">
                                        <div>
                                            <select name="travel_to_country" id="pro_to_country" class="form-control select2">
                                                <option value=""> -- اختر الدولة --</option>
                                                <?php
                                                $stmt = $connect->prepare("SELECT * FROM countries");
                                                $stmt->execute();
                                                $allcountry = $stmt->fetchAll();
                                                foreach ($allcountry as $country) {
                                                ?>
                                                    <option value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div>
                                            <select name="travel_to_city" class="form-control select2" id="pro_to_city">
                                                <option value=""> -- اختر المدينة -- </option>
                                            </select>
                                        </div>
                                    </div>
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
                                    <label for=""> الوزن المتاح (كجم) </label>
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
?>


<script>
    $(document).ready(function() {
        // مكان المغادرة 
        $('#pro_form_country').change(function() {
            var country_id = $(this).val();
            if (country_id != '') {
                $.ajax({
                    url: "get_cities.php",
                    method: "POST",
                    data: {
                        country_id: country_id
                    },
                    success: function(data) {
                        $('#pro_from_city').html(data);
                    }
                });
            } else {
                $('#pro_from_city').html('<option value="">-- اختر المدينة --</option>');
            }
        });
        // مكان الوصول
        $('#pro_to_country').change(function() {
            var country_id = $(this).val();
            if (country_id != '') {
                $.ajax({
                    url: "get_cities.php",
                    method: "POST",
                    data: {
                        country_id: country_id
                    },
                    success: function(data) {
                        $('#pro_to_city').html(data);
                    }
                });
            } else {
                $('#pro_to_city').html('<option value="">-- اختر المدينة --</option>');
            }
        });
    });
</script>