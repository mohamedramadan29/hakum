<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة الشحنات </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->

        <div class="table-responsive">
            <!--
            <div class="add_new_record">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addrecord">
                    اضف كورس جديد <i class="fa fa-plus"></i>
                </button>
            </div>
                                            -->
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم المستخدم </th>
                        <th> اسم المنتج </th>
                        <th> من </th>
                        <th> الي </th>
                        <th> تاريخ الوصول </th>
                        <th> الحالة </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM products
                        ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        $i = 1;
                        foreach ($alltype as $type) { ?> <tr>
                            <td> <?php echo  $i++ ?> </td>
                            <td><?php echo $type['user_name']; ?> </td>
                            <td><?php echo $type['pro_name']; ?> </td>
                            <td><?php
                                $stmt = $connect->prepare("SELECT * FROM  countries WHERE id=?");
                                $stmt->execute(array($type['pro_from_country']));
                                $from_data_country = $stmt->fetch();
                                ////////////
                                $stmt = $connect->prepare("SELECT * FROM  cities WHERE id=?");
                                $stmt->execute(array($type['pro_from_city']));
                                $from_data_city = $stmt->fetch();
                                echo $from_data_city['name'];
                                echo "--";
                                echo $from_data_country['name'];

                                ?> </td>
                            <td> <?php
                                    $stmt = $connect->prepare("SELECT * FROM  countries WHERE id=?");
                                    $stmt->execute(array($type['pro_to_country']));
                                    $from_data_country = $stmt->fetch();
                                    ////////////
                                    $stmt = $connect->prepare("SELECT * FROM  cities WHERE id=?");
                                    $stmt->execute(array($type['pro_to_city']));
                                    $from_data_city = $stmt->fetch();
                                    echo $from_data_city['name'];
                                    echo "--";
                                    echo $from_data_country['name'];

                                    ?> </td>
                            <td> <?php echo $type['arrieve_at']; ?> </td>
                            <td>
                                <?php
                                if ($type['pro_status'] == 0) {
                                ?>
                                    <span class="btn btn-warning btn-sm"> مفتوحة </span>
                                <?php
                                } elseif ($type['pro_status'] == 1) { ?>
                                    <span class="btn btn-success btn-sm"> انتهت </span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=products&page=delete&pro_id=<?php echo $type['pro_id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL TO Edit RECORD  -->
                        <div class="modal fade" id="editrecord<?php echo $type['cus_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=users&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="cus_id" value="<?php echo $type['cus_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم الاول
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="cou_name" value="<?php echo $type['cus_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">الاسم الاخير<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_name_en" value="<?php echo $type['cus_last'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الهاتف<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_mobile'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">البريد الالكتروني<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_email'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الدولة<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cou_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الكورس <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['course_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الجامعه <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['uni_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> التخصص <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['spe_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الدرجة <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['deg_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> حالة المستخدم <span> * </span></label>
                                                            <select name="cus_state" id="" class="form-control">
                                                                <option value=""> تعديل حالة المستخدم </option>
                                                                <option <?php if ($type['cus_state'] == 0) echo "selected" ?> value="0"> غير مفعل </option>
                                                                <option <?php if ($type['cus_state'] == 1) echo "selected" ?> value="1"> مفعل </option>
                                                            </select>

                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en">تاكيد<span> * </span></label>
                                                            <select name="cus_confirm" id="" class="form-control">
                                                                <option value=""> تاكيد المستخدم </option>
                                                                <option <?php if ($type['cus_confirm'] == 0) echo "selected" ?> value="0">لم يتم التاكيد</option>
                                                                <option <?php if ($type['cus_confirm'] == 1) echo "selected" ?> value="1"> تم التاكيد </option>
                                                            </select>

                                                        </div>
                                                        <div class="box submit_box">
                                                            <input class="btn btn-outline-primary btn-sm" name="edit_record" type="submit" value="تعديل المستخدم">
                                                        </div>


                                                    </div>
                                                </div>
                                            </form>
                                            <!-- START RESPONSE SPACE  -->
                                            <!-- area to display a message after completion of upload -->

                                            <br>
                                            <div class='status'></div>
                                            <!-- END RESPONSE SPACE  -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END RECORD TO EDIT NEW RECORD  -->
                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="viewrecord<?php echo $type['cus_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة المستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main_ajax.php?dir=whatsapp&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="cus_id" value="<?php echo $type['cus_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> الاسم الاول
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="cou_name" value="<?php echo $type['cus_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">الاسم الاخير<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_name_en" value="<?php echo $type['cus_last'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">رقم الهاتف<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_mobile'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en">البريد الالكتروني<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cus_email'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الدولة<span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['cou_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الكورس <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['course_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> الجامعه <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['uni_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> التخصص <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['spe_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> الدرجة <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php echo $type['deg_name'] ?>">
                                                        </div>

                                                        <div class="box2">
                                                            <label id="name_en"> حالة المستخدم <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php
                                                                                                                                if ($type['cus_state'] == 0) {
                                                                                                                                    echo "غير مفعل";
                                                                                                                                } else {
                                                                                                                                    echo "مفعل";
                                                                                                                                }
                                                                                                                                ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name_en"> تاكيد المستخدم <span> * </span></label>
                                                            <input class="form-control" type="text" name="cou_info_en" value="<?php
                                                                                                                                if ($type['cus_confirm'] == 0) {
                                                                                                                                    echo "لم يتم التاكيد";
                                                                                                                                } else {
                                                                                                                                    echo "تم التاكيد";
                                                                                                                                }
                                                                                                                                ?>">
                                                        </div>


                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END  MODEL VIEW  -->
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>