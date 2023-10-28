<?php
session_start();
ob_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}
if (isset($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
    $stmt = $connect->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->execute(array($_SESSION['username']));
    $userdata = $stmt->fetch();
    $user_id = $userdata['user_id'];
    $stmt = $connect->prepare("DELETE FROM products WHERE pro_id = ?");
    $stmt->execute(array($pro_id));
    if($stmt){
        header("Location:all_product");
    }
}
ob_end_flush();