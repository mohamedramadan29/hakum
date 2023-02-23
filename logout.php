<?php
session_start();
if (isset($_SESSION['username'])) {
    unset($_SESSION['username']);
}
if (isset($_SESSION['com_id'])) {
    unset($_SESSION['com_id']);
}
header('location:index.php');
session_destroy();
?>