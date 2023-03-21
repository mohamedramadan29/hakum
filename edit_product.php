<?php
$page_title = ' هاكم  - تعديل شحنة ';
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
if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
    $stmt = $connect->prepare("SELECT * FROM products WHERE pro_id = ?");
    $stmt->execute(array($pro_id));
    $pro_data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
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
                                    if (empty($pro_name) || empty($pro_form_country) || empty($pro_to_country) || empty($arrieve_at) || empty($pro_desc) || empty($pro_weight)) {
                                        $errors[] = 'من فضلك ادخل المعلومات كاملة ';
                                    }
                                    if (empty($errors)) {
                                        $stmt = $connect->prepare("UPDATE products SET pro_name=?,pro_weight=?,
                                pro_desc=?,pro_from_country=?,pro_from_city=?,pro_to_country=?,pro_to_city=?,arrieve_at=? WHERE pro_id=?");
                                        $stmt->execute(array(
                                            $pro_name,
                                            $pro_weight,
                                            $pro_desc,
                                            $pro_form_country,
                                            $pro_from_city,
                                            $pro_to_country,
                                            $pro_to_city,
                                            $arrieve_at,
                                            $pro_id
                                        ));
                                        if(!empty($pro_image_temp)){
                                            $stmt = $connect->prepare("UPDATE products SET pro_image=? WHERE pro_id=?");
                                            $stmt->execute(array(
                                                $pro_image_uploaded,$pro_id
                                            ));
                                        }
                                        if ($stmt) {
                                ?>
                                            <li class="alert alert-success"> تم تعديل الشحنة بنجاح </li>
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
                                            <label for=""> اسم المنتج </label>
                                            <input required type="text" name="pro_name" id="pro_name" class="form-control" value="<?php
                                                                                                                                    if (isset($_REQUEST['pro_name'])) {
                                                                                                                                        echo $_REQUEST['pro_name'];
                                                                                                                                    } else {
                                                                                                                                        echo $pro_data['pro_name'];
                                                                                                                                    } ?>">
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
                                                            <option <?php if ($pro_data['pro_from_country'] == $country['id']) echo "selected"; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <select required name="pro_from_city" class="form-control select2" id="pro_from_city">
                                                        <option value=""> -- اختر المدينة -- </option>

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
                                                            <option <?php if ($pro_data['pro_to_country'] == $country['id']) echo "selected"; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div>
                                                    <select required name="pro_to_city" class="form-control select2" id="pro_to_city">
                                                        <option value=""> -- اختر المدينة -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="box">
                                            <label for=""> موعد الوصول المتوقع </label>
                                            <input required type="date" name="arrieve_at" id="arrieve_at" class="form-control" value="<?php
                                                                                                                                        if (isset($_REQUEST['arrieve_at'])) {
                                                                                                                                            echo $_REQUEST['arrieve_at'];
                                                                                                                                        } else {
                                                                                                                                            echo $pro_data['arrieve_at'];
                                                                                                                                        } ?>">
                                        </div>
                                        <div class="box">
                                            <?php
                                            if (!empty($pro_data['pro_image'])) {
                                            ?>
                                                <div>
                                                    <img style="width: 150px; height: 150px;" src="website_uploads/<?php echo $pro_data['pro_image']; ?>" alt="">
                                                </div>
                                            <?php
                                            }
                                            ?>

                                            <label for=""> تعديل صورة المنتج </label>
                                            <input type="file" name="pro_image" id="pro_image" class="form-control" value="<?php if (isset($_REQUEST['pro_image'])) echo $_REQUEST['pro_image'] ?>">
                                        </div>
                                        <div class="box">
                                            <label for=""> وزن المنتج (كجم)</label>
                                            <input required type="number" min="1" name="pro_weight" id="pro_to" class="form-control" value="<?php if (isset($_REQUEST['pro_weight'])) {
                                                                                                                                                echo $_REQUEST['pro_weight'];
                                                                                                                                            } else {
                                                                                                                                                echo $pro_data['pro_weight'];
                                                                                                                                            } ?>">
                                        </div>
                                        <div class="box">
                                            <label for=""> وصف المنتج </label>
                                            <textarea required name="pro_desc" class="form-control"><?php if (isset($_REQUEST['pro_desc'])) {
                                                                                                        echo $_REQUEST['pro_desc'];
                                                                                                    } else {
                                                                                                        echo $pro_data['pro_desc'];
                                                                                                    } ?></textarea>
                                        </div>
                                        <div class="box">
                                            <input type="submit" class="btn btn-primary" name="add_product" value="تعديل الشحنة">
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
    }
    ?>
<?php
} else {
?>
    <script>
        // Wait for the page to load
        window.onload = function() {
            // Redirect to the specified URL
            window.location.href = "index.php";
        };
    </script>
<?php
}
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
                        country_id: country_id,
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