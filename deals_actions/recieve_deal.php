<?php
session_start();
include 'connect.php';
if (isset($_POST['recieve_deal'])) {
    $travel_id = $_POST['travel_id'];
    $travel_owner = $_POST['travel_owner'];
    $product_owner = $_POST['product_owner'];
    $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE ");
    $stmt->execute();
}
