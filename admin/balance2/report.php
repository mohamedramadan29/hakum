<div class="container customer_report">
    <div class="data">
        <div class="bread">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                    <li class="breadcrumb-item active" aria-current="page"> مشاهدة تحويلات الرصيد </li>
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
                        <th> صاحب الشحنة </th>
                        <th> صاحب الرحلة </th>
                        <th> تاريخ الصفقة </th>
                        <th> مبلغ الشحن </th>
                        <th> مبلغ العمولة </th>
                        <th> صافي المبلغ </th>
                        <th> حالة الصفقة </th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $connect->prepare('SELECT * FROM product_deal
                        ');
                    $stmt->execute();
                    $alltype = $stmt->fetchAll();
                    $i = 1;
                    $total_discount = 0;
                    $balance_subtotal = 0;
                    $balance_total = 0;
                    foreach ($alltype as $type) {
                        $total_discount += $type['discount'];
                        $balance_subtotal += $type['sub_total'];
                        $balance_total += $type['total'];
                    ?> <tr>
                            <td> <?php echo  $i++ ?> </td>
                            <td><?php echo $type['product_owner']; ?> </td>
                            <td><?php echo $type['travel_owner']; ?> </td>
                            <td><?php echo $type['date']; ?> </td>
                            <td> <?php echo $type['sub_total']; ?> </td>
                            <td> <?php echo $type['discount']; ?> </td>
                            <td> <?php echo $type['total']; ?> </td>
                            <td> <?php echo $type['status']; ?> </td>
                        </tr> <?php
                                ?>
                    <?php
                    }
                    ?>

                </tbody>
                <tfoot class="bg bg-primary">
                    <tr>
                        <td> المجموع </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bg bg-primary" style="font-size: 22px;"> <strong> <?php echo $balance_subtotal; ?> </strong> دولار </td>
                        <td class="bg bg-danger" style="font-size: 22px;"> <strong> <?php echo $total_discount; ?> </strong> دولار </td>
                        <td class="bg bg-warning" style="font-size: 22px;"> <strong> <?php echo $balance_total; ?> </strong> دولار </td>
                        <td></td>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>