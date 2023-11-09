<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة المستخدمين </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <!-- START MODEL TO ADD NEW RECORD  -->
        <!-- END RECORD TO EDIT NEW RECORD  -->

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
                        <th>الاسم </th>
                        <th>البريد الالكتروني</th>
                        <th> كود الدولة   </th>
                        <th> رقم الهاتف </th>
                        <th> العنوان  </th>
                        <th> الدولة </th>
                        <th> المدينة </th>
                        <th> الحي </th>
                        <th> النوع </th>
                        <th> الجنسية  </th>
                        <th> رقم الهوية </th>
                        <th> الميزانية </th>
                        <th> جواز السفر </th>
                        <th> حالة الحساب </th>
                        <th> العمليات </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM users
                        ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?>
                        <tr>
                            <td> <?php echo $type['name']; ?> </td>
                            <td> <?php echo $type['email']; ?> </td>
                            <td> <?php echo $type['country_code']; ?> </td>
                            <td> <?php echo $type['phone']; ?> </td>
                            <td> <?php echo $type['address']; ?> </td>
                            <td> <?php echo $type['country']; ?> </td>
                            <td> <?php echo $type['city']; ?> </td>
                            <td> <?php echo $type['state']; ?> </td>
                            <td> <?php echo $type['six']; ?> </td>
                            <td> <?php echo $type['nationality']; ?> </td>
                            <td> <?php echo $type['id_number']; ?> </td>
                            <td> <?php echo $type['balance']; ?> </td>
                            <td><a target="_blank" class="btn btn-warning btn-sm" href="../website_uploads/<?php echo $type['passport']; ?>"> <i class="fa fa-eye"></i> </a> </td>
                            <td> <?php
                                    if (
                                        !empty($type['name']) && !empty($type['email']) && !empty($type['phone']) && !empty($type['six']) && !empty($type['id_number']) &&
                                        !empty($type['country']) && !empty($type['profile_image'])  && !empty($type['nationality']) && !empty($type['passport']) && !empty($type['address'])
                                    ) {
                                    ?>
                                    <span class="badge badge-success"> مكتمل </span>
                                <?php
                                    } else {
                                ?>
                                    <span class="badge badge-danger"> غير مكتمل </span>
                                <?php
                                    }
                                ?>
                            </td>
                            <td>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=users&page=delete&user_id=<?php echo $type['user_id']; ?> ">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
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