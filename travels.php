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
                    <div class="col-lg-3">
                        <div class="info">
                            <span class="fa fa-home"></span><input type="text" class="form-control" placeholder="من مدينة | دولة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <span class="fa fa-plane"></span><input type="text" class="form-control" placeholder="الي مدينة | دولة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <input type="date" class="form-control" placeholder=" توقيت الرحلة ">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info">
                            <button class="btn btn-primary search_button"> بحث <i class="fa fa-search"></i> </button>
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
            $stmt = $connect->prepare("SELECT * FROM travels");
            $stmt->execute();
            $total_pages = $stmt->RowCount();
            $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

            $num_result_in_page = 5;
            ?>

            <div class="row">
                <?php
                $stmt = $connect->prepare("SELECT * FROM travels");
                /* $calc_page = ($page - 1) * $num_result_in_page;
                if ($calc_page < 1) {
                    $calc_page = 1;
                }
                */
                //$stmt->bindParam('ii',$calc_page, $num_result_in_page);
                $stmt->execute();
                $alltravel = $stmt->fetchall();
                foreach ($alltravel as $travel) { ?>
                    <div class="col-lg-6 animate__animated animate__fadeInUp animate__delay-0.3s">
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
                                    <p> <span> <img src="uploads/ok.png" alt=""> الحالة : </span> متاح </p>
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
