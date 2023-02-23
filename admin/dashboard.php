<?php
ob_start();
$pagetitle = ' الرئيسية  ';
?>
<div class="container dashboard">
    <div class="bread bread_dasha">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"> <i class="fa fa-heart"></i> <a href="main.php?dir=dashboard&page=dashboard"> <?php echo  $website_title; ?></a> <i class="fa fa-chevron-left"></i> </li>
                <li class="breadcrumb-item active" aria-current="page"> <?php echo $lang['dashboard']; ?> </li>
            </ol>
        </nav>
    </div>
    <div class="dashboard_data">
        <div class="row">
            <div class="col-lg-3">
                <div class="small_box small_box2">
                    <div class="icon">
                        <span> <i class="fa fa-users"></i> </span>
                    </div>
                    <div class="inner">
                        <span> المستخدمين  </span>
                        <?php 
                        $stmt = $connect->prepare("SELECT * FROM users");
                        $stmt->execute();
                        $count= $stmt->rowcount();
                        
                        ?>
                        <h3> <?php echo $count ?> </h3>
                    </div>
                    <div class="small_box_footer">
                        
                        <p> <a class="btn btn-primary btn-sm" href="main.php?dir=users&page=report"> مشاهدة المستخدمين </a> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small_box small_box2">
                    <div class="icon">
                        <span> <i class="fa fa-book"></i> </span>
                    </div>
                    <div class="inner">
                        <span> الشحنات   </span>
                        <?php 
                        $stmt = $connect->prepare("SELECT * FROM products");
                        $stmt->execute();
                        $count= $stmt->rowcount();
                        
                        ?>
                        <h3> <?php echo $count ?> </h3>
                    </div>
                    <div class="small_box_footer">
                        
                        <p> <a class="btn btn-primary btn-sm" href="main.php?dir=products&page=report"> مشاهدة الشحنات </a> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small_box small_box2">
                    <div class="icon">
                        <span> <i class="fa fa-plane"></i> </span>
                    </div>
                    <div class="inner">
                        <span> الرحلات   </span>
                        <?php 
                        $stmt = $connect->prepare("SELECT * FROM travels");
                        $stmt->execute();
                        $count= $stmt->rowCount();
                        
                        ?>
                        <h3> <?php echo $count ?> </h3>
                    </div>
                    <div class="small_box_footer">
                        
                        <p> <a class="btn btn-primary btn-sm" href="main.php?dir=travels&page=report"> مشاهدة الشحنات </a> </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="small_box small_box2">
                    <div class="icon">
                        <span> <i class="fa fa-dollar"></i> </span>
                    </div>
                    <div class="inner">
                        <span> شحن الرصيد   </span>
                        <?php 
                        $stmt = $connect->prepare("SELECT * FROM balance_add");
                        $stmt->execute();
                        $count= $stmt->rowcount();
                        
                        ?>
                        <h3> <?php echo $count ?> </h3>
                    </div>
                    <div class="small_box_footer">
                        
                        <p> <a class="btn btn-primary btn-sm" href="main.php?dir=balance&page=report"> مشاهدة التحويلات  </a> </p>
                    </div>
                </div>
            </div>
          
        </div>
    </div>


</div>


<?php ob_end_flush();
?>