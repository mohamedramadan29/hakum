<?php
ob_start();
$pagetitle = 'الرئيسية';
session_start();
include 'init.php';
?>
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
        if ($dir == 'company' && $page == 'add') {
            include 'company/add.php';
        } elseif ($dir == 'company' && $page == 'edit') {
            include 'company/edit.php';
        }
        // END EDUCATION WEB SITE ///////////////////////////////////////
        // START individual
        if ($dir == 'individual' && $page == 'add') {
            include 'individual/add.php';
        } elseif ($dir == 'individual' && $page == 'edit') {
            include 'individual/edit.php';
        }
        // END individual WEB SITE ///////////////////////////////////////
        // START Coashes
        if ($dir == 'coashes' && $page == 'add') {
            include 'coashes/add.php';
        } elseif ($dir == 'coashes' && $page == 'edit') {
            include 'coashes/edit.php';
        }
        // START REVIEW
        if ($dir == 'review' && $page == 'com_review') {
        } elseif ($dir == 'review' && $page == 'edit_com') {
            include 'review/edit_com.php';
        } elseif ($dir == 'review' && $page == 'edit_ind') {
            include 'review/edit_ind.php';
        }
        // END REVIEW 
        // START Batches
        if ($dir == 'batches' && $page == 'add') {
            include 'batches/add.php';
        } elseif ($dir == 'batches' && $page == 'edit') {
            include 'batches/edit.php';
        }
        // Start Services Section
        if ($dir == 'services_section' && $page == 'add') {
            include 'services_section/add.php';
        } elseif ($dir == 'services_section' && $page == 'edit') {
            include 'services_section/edit.php';
        }
        // END Services Section
        // Start EXAM Section
        if ($dir == 'exam' && $page == 'add') {
            include 'exam/add.php';
        } elseif ($dir == 'exam' && $page == 'edit') {
            include 'exam/edit.php';
        }
        // END EXAM Section
        // START QUESTION
        if ($dir == 'question' && $page == 'add') {
            include 'question/add.php';
        } elseif ($dir == 'question' && $page == 'edit') {
            include 'question/edit.php';
        }
        // END QUESTION
        // END Services Section
        if ($dir == 'chat' && $page == 'add') {
            include 'chat/add.php';
        }
        // Start Chat Section
        // ٍStart with Draw
        if ($dir == 'withdraw' && $page == 'edit') {
            include 'withdraw/edit.php';
        }
        // end With Draw
        // END SEP WEB SITE ///////////////////////////////////////

        // END users

        ?>