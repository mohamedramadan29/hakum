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
        // START COMPANY
        if ($dir == 'users' && $page == 'add') {
        } elseif ($dir == 'users' && $page == 'edit') {
        } elseif ($dir == 'users' && $page == 'delete') {
            include 'users/delete.php';
        } elseif ($dir == 'users' && $page == 'report') {
            include 'users/report.php';
        } elseif ($dir == 'users' && $page == 'view') {
            include 'users/view.php';
        }
        // END COMPANY
 
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