<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> طلبات سحب المستخدمين </li>
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
                        <th> البريد الالكتروني </th>
                        <th> تاريخ الطلب </th>
                        <th> المبلغ </th>
                        <th> الحالة </th>
                        <th> </th>
                    </tr>
                </thead>
                <tbody> <?php
                        $stmt = $connect->prepare('SELECT * FROM withdraw
                        ');
                        $stmt->execute();
                        $alltype = $stmt->fetchAll();
                        $i = 1;
                        foreach ($alltype as $type) { ?> <tr>
                            <td> <?php echo  $i++ ?> </td>
                            <td><?php echo $type['user']; ?> </td>
                            <td> <?php echo $type['email']; ?> </td>
                            <td> <?php echo $type['date']; ?> </td>
                            <td> <?php echo $type['price']; ?> </td>
                            <td>
                                <?php
                                if ($type['status'] == 0) {
                                ?>
                                    <span class="btn btn-warning btn-sm"> تحت التنفيذ </span>
                                <?php
                                } elseif ($type['status'] == 1) {
                                ?>
                                    <span class="btn btn-danger btn-sm"> تمت </span>
                                <?php
                                } else {
                                ?>
                                    <span class="btn btn-primary btn-sm"> ملغية </span>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <?php if ($type['status'] == 1) {
                                ?>
                                    <button class="btn btn-warning btn-sm"> تم الارسال </button>
                                <?php
                                } else {
                                ?>
                                    <form action="" method="post">
                                        <input type="hidden" name="with_id" value="<?php echo $type['id'] ?>">
                                        <button class="btn btn-primary btn-sm" type="submit" name="send_money"> ارسال المستحقات <i class="fa fa-paypal"></i> </button>
                                    </form>
                                <?php
                                } ?>

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

<?php

if (isset($_POST['send_money'])) {
    $with_id = $_POST['with_id'];
    $stmt = $connect->prepare("SELECT * FROM withdraw WHERE id = ? AND status = 0");
    $stmt->execute(array($with_id));
    $with_data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare("UPDATE  withdraw SET status = 1 WHERE id=?");
        $stmt->execute(array($with_id));
        if ($stmt) {
            $stmt = $connect->prepare("INSERT INTO all_notification (noti_from, noti_to , message , date , noti_desc , noti)
            VALUES(:zfrom,:zto,:zmessage,:zdate,:znoti_desc)");
            $stmt->execute(array(
                "zfrom" => "هاكم ",
                "zto" => $with_data['user'],
                "zmessage" => " تم استلام وارسال طلب السحب الخاص بك  ",
                "zdate" => date('Y-m-d H:i:s'),
                "znoti_desc" => " طلب سحب  ",
            ));
        }
        header('refresh:0;url=main.php?dir=withdraw&page=report');
    }
}

?>