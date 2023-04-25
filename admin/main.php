<?php
ob_start();
$pagetitle = 'الرئيسية';
session_start();
include 'init.php';
include $tem . 'top_navbar.php';
include $tem . 'left_sidebar.php';
?>
<div class="content-wrapper">
    <div class="category">
        <?php
        $page = '';
        if (isset($_GET['page']) && isset($_GET['dir'])) {
            $page = $_GET['page'];
            $dir = $_GET['dir'];
        } else {
            $page = 'manage';
        }


        // START EDUCATION WEB  /////////////////////////////////////////
        // START users 
        if ($dir == 'users' && $page == 'add') {
        } elseif ($dir == 'users' && $page == 'edit') {
        } elseif ($dir == 'users' && $page == 'delete') {
            include 'users/delete.php';
        } elseif ($dir == 'users' && $page == 'report') {
            include 'users/report.php';
        } elseif ($dir == 'users' && $page == 'view') {
            include 'users/view.php';
        }
        // END users 

        // START travels  
        if ($dir == 'travels' && $page == 'add') {
        } elseif ($dir == 'travels' && $page == 'edit') {
        } elseif ($dir == 'travels' && $page == 'delete') {
            include 'travels/delete.php';
        } elseif ($dir == 'travels' && $page == 'report') {
            include 'travels/report.php';
        } elseif ($dir == 'travels' && $page == 'view') {
            include 'travels/view.php';
        }
        // END travels 
        // START products  
        if ($dir == 'products' && $page == 'add') {
        } elseif ($dir == 'products' && $page == 'edit') {
        } elseif ($dir == 'products' && $page == 'delete') {
            include 'products/delete.php';
        } elseif ($dir == 'products' && $page == 'report') {
            include 'products/report.php';
        } elseif ($dir == 'products' && $page == 'view') {
            include 'products/view.php';
        }
        // END products 

        // START balance   
        if ($dir == 'balance' && $page == 'add') {
        } elseif ($dir == 'balance' && $page == 'edit') {
        } elseif ($dir == 'balance' && $page == 'delete') {
            include 'balance/delete.php';
        } elseif ($dir == 'balance' && $page == 'report') {
            include 'balance/report.php';
        }
        // END balance  
        // START balance   
        if ($dir == 'balance2' && $page == 'add') {
        } elseif ($dir == 'balance2' && $page == 'edit') {
        } elseif ($dir == 'balance2' && $page == 'delete') {
            include 'balance2/delete.php';
        } elseif ($dir == 'balance2' && $page == 'report') {
            include 'balance2/report.php';
        }
        // END balance  
        // START Withdraw
        if ($dir == 'withdraw' && $page == 'add') {
        } elseif ($dir == 'withdraw' && $page == 'edit') {
        } elseif ($dir == 'withdraw' && $page == 'delete') {
            include 'withdraw/delete.php';
        } elseif ($dir == 'withdraw' && $page == 'report') {
            include 'withdraw/report.php';
        }
        // END Withdraw
        // START Settings   
        if ($dir == 'settings' && $page == 'add') {
        } elseif ($dir == 'settings' && $page == 'edit') {
            include 'settings/edit.php';
        } elseif ($dir == 'settings' && $page == 'delete') {
            include 'settings/delete.php';
        } elseif ($dir == 'settings' && $page == 'report') {
            include 'settings/report.php';
        }
        // END Settings  
        // START Contact    
        if ($dir == 'contact' && $page == 'add') {
        } elseif ($dir == 'contact' && $page == 'edit') {
            include 'contact/edit.php';
        } elseif ($dir == 'contact' && $page == 'delete') {
            include 'contact/delete.php';
        } elseif ($dir == 'contact' && $page == 'report') {
            include 'contact/report.php';
        }
        // END Contact  
        // START dashbaord    
        if ($dir == 'dashboard' && $page == 'dashboard') {
            include 'dashboard.php';
        }
        // END dashbaord  
        ?>
    </div>
</div>
</div>
<?php
include $tem . 'footer.php';

ob_end_flush();
?>
<script type="text/javascript">
    // customer script


    var dev = $("#logo").dropify({});
    dev = dev.data("dropify")
    var dev2 = $("#logo2").dropify({});
    dev2 = dev2.data("dropify")
    var dev3 = $("#logo3").dropify({});
    dev2 = dev3.data("dropify")
    var dev4 = $("#logo4").dropify({});
    dev4 = dev4.data("dropify")
</script>

<script>
    $(function() {
        $("#rating").rateYo({
            rating: 2,
            fullStar: true,
            starWidth: "27px"
        });
    });

    // Getter
    var normalFill = $("#rating").rateYo("option", "fullStar"); //returns true

    // Setter
    $("#rating").rateYo("option", "fullStar", true); //returns a jQuery Element

    // END ACTIVE LINK
</script>

<script>
    /*
    $('.is_right').each(function(){
        $(this).click(function(){
            $('.is_right').prop('checked',false);
            $(this).prop('checked',true);
        })
    })*/
</script>