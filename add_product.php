<?php
$page_title = ' هاكم  - اضافة شحنة ';
session_start();
include 'init.php';
?>
<div class="profile">
    <div class="container-fluid">
        <div class="data">
            <div class="row">
                <div class="col-lg-4">
                    <div class="slide1">
                        <div class="personal_image">
                            <img src="uploads/profile.png" alt="">
                            <h3> Mohamed Ramadan </h3>
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
                                        <div class="control_setting_section">
                                            <i class="fa fa-user"></i>
                                            <p> حسابي </p>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="add_product">
                                        <div class="control_setting_section active">
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

                        if (isset($_POST['add_product'])) {
                            $pro_name = $_POST['pro_name'];
                            $pro_form = $_POST['pro_form'];
                            $pro_to = $_POST['pro_to'];
                            $arrieve_at = $_POST['arrieve_at'];
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
                            if (empty($pro_name) || empty($pro_form) || empty($pro_to) || empty($arrieve_at)) {
                                $errors[] = 'من فضلك ادخل المعلومات كاملة ';
                            }
                            if (empty($errors)) {
                                $stmt = $connect->prepare("INSERT INTO products (pro_name,pro_image,pro_from,pro_to,arrieve_at,user_name)
                                VALUES(:zname,:zimage,:zfrom,:zto,:zarrive_at,:zuser_id)");
                                $stmt->execute(array(
                                    'zname' => $pro_name,
                                    'zimage' => $pro_image_uploaded,
                                    'zfrom' => $pro_form,
                                    'zto' => $pro_to,
                                    'zarrive_at' => $arrieve_at,
                                    'zuser_id' => $_SESSION['username'],
                                ));
                                if ($stmt) {
                        ?>
                                    <li class="alert alert-success"> تم اضافة الشحنة بنجاح </li>
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
                                    <input type="text" name="pro_name" id="pro_name" class="form-control" value="<?php if (isset($_REQUEST['pro_name'])) echo $_REQUEST['pro_name'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> مكان المغادرة </label>
                                    <input type="text" name="pro_form" id="pro_form" class="form-control" value="<?php if (isset($_REQUEST['pro_form'])) echo $_REQUEST['pro_form'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> مكان الوصول </label>
                                    <input type="text" name="pro_to" id="pro_to" class="form-control" value="<?php if (isset($_REQUEST['pro_to'])) echo $_REQUEST['pro_to'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> موعد الوصول المتوقع </label>
                                    <input type="date" name="arrieve_at" id="arrieve_at" class="form-control" value="<?php if (isset($_REQUEST['arrieve_at'])) echo $_REQUEST['arrieve_at'] ?>">
                                </div>
                                <div class="box">
                                    <label for=""> صورة المنتج </label>
                                    <input type="file" name="pro_image" id="pro_image" class="form-control" value="<?php if (isset($_REQUEST['pro_image'])) echo $_REQUEST['pro_image'] ?>">
                                </div>
                                <div class="box">
                                    <input type="submit" class="btn btn-primary" name="add_product" value="اضافة شحنة ">
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
