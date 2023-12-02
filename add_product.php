<?php
$page_title = ' هاكم  - اضافة شحنة ';
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
$name = $userdata['name'];
$email = $userdata['email'];
$phone = $userdata['phone'];
$profile_image = $userdata['profile_image'];
$address = $userdata['address'];
$country = $userdata['country'];
$passport = $userdata['passport'];
$six = $userdata['six'];
$id_number = $userdata['id_number'];
$nationality = $userdata['nationality'];
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
                                        <div class="control_setting_section active">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="slide2">
                        <?php

                        if (isset($_POST['add_product'])) {
                            $pro_name = $_POST['pro_name'];
                            $pro_form_country = $_POST['pro_form_country'];
                            $pro_from_city = $_POST['pro_from_city'];
                            $pro_to_country = $_POST['pro_to_country'];
                            $pro_to_city = $_POST['pro_to_city'];

                            $arrieve_at = $_POST['arrieve_at'];
                            $pro_weight = $_POST['pro_weight'];
                            $pro_desc = $_POST['pro_desc'];
                            if (!empty($_FILES['pro_image']['name'])) {
                                $pro_image_name = $_FILES['pro_image']['name'];
                                $pro_image_temp = $_FILES['pro_image']['tmp_name'];
                                $pro_image_type = $_FILES['pro_image']['type'];
                                $pro_image_size = $_FILES['pro_image']['size'];
                                $pro_image_uploaded = time() . '_' . $pro_image_name;
                                move_uploaded_file(
                                    $pro_image_temp,
                                    'website_uploads/' . $pro_image_uploaded
                                );
                            } else {
                                $pro_image_uploaded = '';
                            }
                            $errors = [];
                            if (empty($address) || empty($name) || empty($email) || empty($phone) || empty($profile_image) || empty($passport) || empty($six) || empty($id_number) || empty($country) || empty($nationality)) {
                                $errors[] = 'من فضلك ادخل المعلومات كاملة ';
                            }
                            if (empty($errors)) {
                                $stmt = $connect->prepare("INSERT INTO products (pro_name,pro_weight,pro_image,
                                pro_desc,pro_from_country,pro_from_city,pro_to_country,pro_to_city,arrieve_at,user_name,user_id)
                                VALUES(:zname,:zweight,:zimage,:zdesc,:zfrom_country,:zfrom_city,:zto_country,:zto_city,:zarrive_at,:zuser_name,:zuser_id)");
                                $stmt->execute(array(
                                    'zname' => $pro_name,
                                    'zweight' => $pro_weight,
                                    'zimage' => $pro_image_uploaded,
                                    'zdesc' => $pro_desc,
                                    'zfrom_country' => $pro_form_country,
                                    'zfrom_city' => $pro_from_city,
                                    'zto_country' => $pro_to_country,
                                    'zto_city' => $pro_to_city,
                                    'zarrive_at' => $arrieve_at,
                                    'zuser_name' => $_SESSION['username'],
                                    'zuser_id' => $user_id,
                                ));
                                if ($stmt) {
                        ?>
                                    <li class="alert alert-success"> تم اضافة الشحنة بنجاح</li>
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
                        <?php
                        if (empty($name) || empty($email) || empty($phone) || empty($profile_image) || empty($passport) || empty($six) || empty($id_number)) {
                        ?>
                            <div class="alert alert-danger"> من فضلك ادخل معلوماتك كاملة للتمكن من الأضافة</div>
                        <?php
                        } else {
                        ?>
                            <div class="my_form">
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="box">
                                        <label for=""> اسم المنتج </label>
                                        <input required type="text" name="pro_name" id="pro_name" class="form-control" value="<?php if (isset($_REQUEST['pro_name'])) echo $_REQUEST['pro_name'] ?>">
                                    </div>
                                    <div class="box">
                                        <label for=""> مكان المغادرة </label>
                                        <div class="pro_from">
                                            <div>
                                                <select name="pro_form_country" id="pro_form_country" class="form-control select2">
                                                    <option value=""> -- اختر الدولة --</option>
                                                    <?php
                                                    $stmt = $connect->prepare("SELECT * FROM countries");
                                                    $stmt->execute();
                                                    $allcountry = $stmt->fetchAll();
                                                    foreach ($allcountry as $country) {
                                                    ?>
                                                        <option value="<?php echo $country['id']; ?>"> <?php echo $country['name']; ?> </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <select name="pro_from_city" class="form-control select2" id="pro_from_city">
                                                    <option value=""> -- اختر المدينة --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box">
                                        <label for=""> مكان الوصول </label>
                                        <div class="pro_from">
                                            <div>
                                                <select name="pro_to_country" id="pro_to_country" class="form-control select2">
                                                    <option value=""> -- اختر الدولة --</option>
                                                    <?php
                                                    $stmt = $connect->prepare("SELECT * FROM countries");
                                                    $stmt->execute();
                                                    $allcountry = $stmt->fetchAll();
                                                    foreach ($allcountry as $country) {
                                                    ?>
                                                        <option value="<?php echo $country['id']; ?>"> <?php echo $country['name']; ?> </option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <select name="pro_to_city" class="form-control select2" id="pro_to_city">
                                                    <option value=""> -- اختر المدينة --</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box">
                                        <label for=""> موعد الوصول المتوقع </label>
                                        <input min="2023-09-30" required type="date" name="arrieve_at" id="arrieve_at" class="form-control" value="<?php if (isset($_REQUEST['arrieve_at'])) echo $_REQUEST['arrieve_at'] ?>">
                                    </div>
                                    <div class="box">
                                        <label for=""> صورة المنتج </label>
                                        <input required type="file" name="pro_image" id="pro_image" class="form-control" value="<?php if (isset($_REQUEST['pro_image'])) echo $_REQUEST['pro_image'] ?>">
                                    </div>
                                    <div class="box">
                                        <label for=""> وزن المنتج (كجم)</label>
                                        <input required type="number" min="1" name="pro_weight" id="pro_to" class="form-control" value="<?php if (isset($_REQUEST['pro_weight'])) echo $_REQUEST['pro_weight'] ?>">
                                    </div>
                                    <div class="box">
                                        <label for=""> وصف المنتج </label>
                                        <textarea required name="pro_desc" class="form-control"><?php if (isset($_REQUEST['pro_desc'])) echo $_REQUEST['pro_desc'] ?></textarea>
                                    </div>
                                    <div class="box">
                                        <input type="submit" class="btn btn-primary" name="add_product" value="اضافة شحنة ">
                                    </div>
                                </form>
                            </div>
                        <?php
                        }
                        ?>

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