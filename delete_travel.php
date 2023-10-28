<?php
session_start();
ob_start();
include 'init.php';
if (isset($_SESSION['username'])) {
} else {
    header("Location:login");
}
if (isset($_GET['travel_id'])) {
    $travel_id = $_GET['travel_id'];
    $stmt = $connect->prepare("SELECT * FROM users WHERE name = ?");
    $stmt->execute(array($_SESSION['username']));
    $userdata = $stmt->fetch();
    $user_id = $userdata['user_id'];
    $stmt = $connect->prepare("DELETE FROM travels WHERE travel_id  = ?");
    $stmt->execute(array($travel_id));
    if($stmt){
        header("Location:all_travel");
    }
}
ob_end_flush();