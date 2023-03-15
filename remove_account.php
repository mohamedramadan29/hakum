<?php
$page_title = ' هاكم ';
session_start();
include 'connect.php';

$username = $_SESSION['username'];
$stmt = $connect->prepare("DELETE FROM users WHERE name=?");
$stmt->execute(array($username));

header('location:index.php');
session_destroy();


include $tem . 'footer.php';

?>