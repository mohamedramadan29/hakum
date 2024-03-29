<?php
$page_title = ' هاكم - رحلات  ';
session_start();
include 'init.php';
?>
<!-- START HERO SECTION  -->
<div class="form_search">
    <div class="container-fluid">
        <div class="travel_head">
            <h2> جميع الرحلات </h2>
            <a href="add_travel" class="btn btn-primary"> اضف رحلة جديدة <i class="fa fa-plane"></i> </a>
        </div>
        <div class="data">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="info2">
                            <!-- <input type="text" class="form-control" placeholder=" مكان المغادرة  "> -->
                            <select name="travel_from_country" id="" class="form-control select2">
                                <option value=""> -- اختر مكان المغادرة --</option>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM countries");
                                $stmt->execute();
                                $allcountry = $stmt->fetchAll();
                                foreach ($allcountry as $country) {
                                ?>
                                    <option <?php if (isset($_REQUEST['travel_from_country']) && ($_REQUEST['travel_from_country'] == $country['id'])) echo 'selected'; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="info2">
                            <!-- <input type="text" class="form-control" placeholder=" مكان المغادرة  "> -->
                            <select name="travel_to_country" id="" class="form-control select2">
                                <option value=""> -- اختر مكان الوصول --</option>
                                <?php
                                $stmt = $connect->prepare("SELECT * FROM countries");
                                $stmt->execute();
                                $allcountry = $stmt->fetchAll();
                                foreach ($allcountry as $country) {
                                ?>
                                    <option <?php if (isset($_REQUEST['travel_to_country']) && ($_REQUEST['travel_to_country'] == $country['id'])) echo 'selected'; ?> value="<?php echo $country['id']; ?>"> <?php echo  $country['name']; ?> </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="info">
                            <button type="submit" class="btn btn-primary search_button" name="search_button"> بحث <i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END HERO SECTION  -->
<!-- START LATEST TRAVEL  -->
<div class="travel travel_page">
    <div class="container-fluid">
        <div class="data">
            <?php
            if (isset($_POST['search_button'])) {
                $travel_from = $_POST['travel_from_country'];
                $travel_to = $_POST['travel_to_country'];
                if ($travel_from == '' && $travel_to == '') {
                    $stmt = $connect->prepare("SELECT * FROM travels");
                    $stmt->execute();
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($travel_from != '') {
                    $stmt = $connect->prepare("SELECT * FROM travels WHERE travel_from_country=?");
                    $stmt->execute(array($travel_from));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($travel_to != '') {
                    $stmt = $connect->prepare("SELECT * FROM travels WHERE travel_to_country=?");
                    $stmt->execute(array($travel_to));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } elseif ($travel_from != '' && $travel_to != '') {
                    $stmt = $connect->prepare("SELECT * FROM travels WHERE travel_from_country=? AND travel_to_country=?");
                    $stmt->execute(array($travel_from, $travel_to));
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                } else {
                    $stmt = $connect->prepare("SELECT * FROM travels");
                    $stmt->execute();
                    $alltravel = $stmt->fetchall();
                    $count = $stmt->rowCount();
                }
            } else {
                $stmt = $connect->prepare("SELECT * FROM travels");
                $stmt->execute();
                $alltravel = $stmt->fetchall();
                $count = $stmt->rowCount();
            ?>

            <?php
            }
            ?>
            <?php
            if ($count > 0) {
            ?>
                <div class="row">
                    <?php

                    foreach ($alltravel as $travel) { ?>
                        <div class="col-lg-4 animate__animated animate__fadeInUp animate__delay-0.3s">
                            <div class="travel_data">
                                <div class="info">
                                    <div class="product">
                                    </div>
                                    <div class="product_info">
                                        <p> <span> <img src="uploads/from.png" alt=""> من : </span>
                                            <?php
                                            $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                            $stmt->execute(array($travel['travel_from_country']));
                                            $country_data = $stmt->fetch();
                                            $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                            $stmt->execute(array($travel['travel_from_city']));
                                            $city_data = $stmt->fetch();
                                            echo $country_data['name'] . "-" . $city_data['name']
                                            ?>
                                        </p>
                                        <p> <span> <img src="uploads/airport.png" alt=""> الي : </span>
                                            <?php
                                            $stmt = $connect->prepare("SELECT * FROM countries WHERE id = ? ");
                                            $stmt->execute(array($travel['travel_to_country']));
                                            $country_data = $stmt->fetch();
                                            $stmt = $connect->prepare("SELECT * FROM cities WHERE id = ? ");
                                            $stmt->execute(array($travel['travel_to_city']));
                                            $city_data = $stmt->fetch();
                                            echo $country_data['name'] . "-" . $city_data['name']  ?>
                                        </p>
                                        <p> <span> <img src="uploads/timer.png" alt=""> موعد الرحلة : </span> <?php echo $travel['travel_date'] ?> </p>
                                        <p> <span> <img src="uploads/weight.png" alt=""> الوزن المتاح : </span> <?php echo $travel['av_weight'] ?> كجم </p>
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE travel_id = ?");
                                        $stmt->execute(array($travel['travel_id']));
                                        $deal_data = $stmt->fetch();
                                        $count_deal = $stmt->rowCount();
                                        if ($count_deal > 0) {
                                            if ($deal_data['status'] == 1) { ?>
                                                <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> تحت التنفيذ </p>
                                            <?php
                                            } elseif ($deal_data['status'] == 2) { ?>
                                                <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> تمت </p>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> متاح </p>
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="person_info">
                                    <div class="image_person">
                                        <?php
                                        $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                                        $stmt->execute(array($travel['user_name']));
                                        $userdata = $stmt->fetch();
                                        if ($userdata['profile_image'] != "") {
                                        ?>
                                            <img src="website_uploads/<?php echo $userdata['profile_image'] ?>" alt="">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="uploads/avatar.gif" alt="">
                                        <?php
                                        }
                                        ?>

                                        <p> <?php echo $travel['user_name'] ?> </p>
                                        <?php
                                        if (
                                            !empty($userdata['name']) && !empty($userdata['email']) && !empty($userdata['phone']) && !empty($userdata['six']) && !empty($userdata['id_number']) &&
                                            !empty($userdata['country']) && !empty($userdata['profile_image'])  && !empty($userdata['nationality']) && !empty($userdata['passport']) && !empty($userdata['address'])
                                        ) {
                                        ?>
                                            <span style="display: block;"><i class="fa fa-check" style="color:#fff;background-color: #0463ca;  border-radius: 50%; margin-right: 10px;   width: 16px;  height: 16px;  line-height: 16px;  text-align: center; font-size: 10px;"></i></span>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="send_request">
                                        <?php
                                        if (isset($_SESSION['username'])) {
                                            if ($_SESSION['username'] === $travel['user_name']) {
                                        ?>
                                                <a href="all_travel" class="button btn"> تفاصيل الرحلة </a>
                                            <?php
                                            } else {
                                            ?>
                                                <a href="message?user=<?php echo $travel['user_name'] ?>&travel_id=<?php echo $travel['travel_id']; ?>" class="button btn"> التفاصيل وارسال طلب </a>
                                            <?php
                                            }
                                        } else {
                                            ?>
                                            <a href="login" class="button btn"> التفاصيل وارسال طلب </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php

                    }
                    ?>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-info"> لا يوجد بيانات !! </div>
            <?php
            }
            ?>

        </div>
        <div class="pagin">
            <nav aria-label="...">
                <?php
                /*
                if (ceil($total_pages / $num_result_in_page) > 0) { ?>
                    <ul class="pagination">
                        <?php if ($page > 1) : ?>
                            <li class="prev"><a href="travels?page=<?php echo $page - 1 ?>">Prev</a></li>
                        <?php endif; ?>

                        <?php if ($page > 3) : ?>
                            <li class="start"><a href="travels?page=1">1</a></li>
                            <li class="dots">...</li>
                        <?php endif; ?>

                        <?php if ($page - 2 > 0) : ?><li class="page"><a href="travels?page=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                        <?php if ($page - 1 > 0) : ?><li class="page"><a href="travels?page=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                        <li class="currentpage"><a href="travels?page=<?php echo $page ?>"><?php echo $page ?></a></li>

                        <?php if ($page + 1 < ceil($total_pages / $num_result_in_page) + 1) : ?><li class="page"><a href="travels?page=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                        <?php if ($page + 2 < ceil($total_pages / $num_result_in_page) + 1) : ?><li class="page"><a href="travels?page=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                        <?php if ($page < ceil($total_pages / $num_result_in_page) - 2) : ?>
                            <li class="dots">...</li>
                            <li class="end"><a href="travels?page=<?php echo ceil($total_pages / $num_result_in_page) ?>"><?php echo ceil($total_pages / $num_result_in_page) ?></a></li>
                        <?php endif; ?>

                        <?php if ($page < ceil($total_pages / $num_result_in_page)) : ?>
                            <li class="next"><a href="travels?page=<?php echo $page + 1 ?>">Next</a></li>
                        <?php endif; ?>
                    </ul>
                    <!--
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">السابق</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">التالي </a>
                        </li>
                    </ul>
                -->
                <?php

                }
                */
                ?>
            </nav>
        </div>
    </div>
</div>
<!-- END LATEST TRAVEL  -->
<div class="register_now">
    <div class="overlay">
        <div class="container">
            <div class="data">
                <h2> سجل الان في هاكم </h2>
                <p> نعمل على توفير الحلول التشاركية في النقل بين الأفراد لتحصيل المنافع المشتركة
                </p>
                <a href="#" class="button btn"> سجل الان </a>
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