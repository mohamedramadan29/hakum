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
                        <span> <i class="fa fa-cart-plus"></i> </span>
                    </div>
                    <div class="inner">
                        <span> الاعضاء </span>
                        <h3> 10 </h3>
                    </div>
                    <div class="small_box_footer">
                        
                        <p> <a class="btn btn-primary btn-sm" href="main.php?dir=cars&page=report"> مشاهدة الاعضاء </a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>


<?php ob_end_flush();
?>