<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo  $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة تقسيمات الادمن </li>
                </ol>
            </nav>
        </div>
        <!-------------------------- START NEW WHATSAPP MEMEBER------------------------->
        <!-- Content Row -->
        <div class="table-responsive">
            <table id="tableone" class="table table-light table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th> اسم المستخدم </th>
                        <th> البريد الالكتروني </th>
                        <th> اسم القسم </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM admin ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        foreach ($alltype as $type) { ?> <tr>
                            <td><?php echo $type['admin_name']; ?> </td>
                            <td><?php echo $type['admin_email']; ?> </td>
                            <td> <?php
                                    if ($type['admin_prev'] == 1) {
                                        echo ' الادمن العام  ';
                                    }
                                    if ($type['admin_prev'] == 2) {
                                        echo ' فريق الخدمة  ';
                                    }
                                    if ($type['admin_prev'] == 3) {
                                        echo ' المدرب ';
                                    }

                                    ?> </td>

                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editrecord<?php echo $type['admin_id']; ?>">
                                    تعديل <i class="fa fa-eye"></i>
                                </button>

                            </td>
                        </tr> <?php
                                ?>
                        <!-- START MODEL VIEW  -->
                        <div class="modal fade" id="editrecord<?php echo $type['admin_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">مشاهدة المستخدم</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="myform">
                                            <form class="form-group insert ajax_form" action="main.php?dir=settings&page=edit" method="POST" autocomplete="on" enctype="multipart/form-data">
                                                <input type="hidden" name="admin_id" value="<?php echo $type['admin_id'] ?>">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="box2">
                                                            <label id="name"> اسم المستخدم
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="admin_name" value="<?php echo $type['admin_name'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> البريد الالكتروني
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="email" name="admin_email" value="<?php echo $type['admin_email'] ?>">
                                                        </div>
                                                        <div class="box2">
                                                            <label id="name"> كلمة المرور
                                                                <span> * </span> </label>
                                                            <input required class="form-control" type="text" name="admin_password" value="<?php echo $type['admin_password'] ?>">
                                                        </div>

                                                    </div>
                                                    <div class="box submit_box">
                                                        <input class="btn btn-outline-primary btn-sm" name="" type="submit" value="  تعديل القسم   ">
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> <i class="fa fa-close"></i> اغلاق </button>
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