<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> رسائل صفحة التواصل </li>
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
                        <th> الاسم </th>
                        <th> البريد الالكتروني </th>
                        <th> عنوان الرسالة </th>
                        <th> نص الرسالة </th>
                        <th> التاريخ </th>
                        <th></th>

                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM contact_us
                        ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        $i = 1;
                        foreach ($alltype as $type) { ?> <tr>
                            <td> <?php echo  $i++ ?> </td>
                            <td><?php echo $type['name']; ?> </td>
                            <td><?php echo $type['email']; ?> </td>
                            <td> <?php echo $type['subject']; ?> </td>
                            <td> <?php echo $type['message']; ?> </td>
                            <td> <?php echo $type['time']; ?> </td>
                            <td>
                                <a class="confirm btn btn-danger btn-sm" href="main.php?dir=contact&page=delete&con_id=<?php echo $type['id']; ?> ">
                                    حذف <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr> <?php
                                ?>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>