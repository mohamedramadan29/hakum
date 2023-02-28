<?php
include "../connect.php";
if (isset($_POST['msg']) && $_POST['msg'] != '') {

    $from_person = $_POST['from_person'];
    $to_person = $_POST['to_person'];
    $msg = $_POST['msg'];
    $date = date("Y-m-d h:i:sa");
    $travel_id = $_POST['travel_id'];
    $stmt = $connect->prepare("INSERT INTO chat (msg_from, msg_to, msg, date,travel_id)
    value(:zfrom, :zto, :zmsg , :zdate,:ztravel_id)
    ");
    $stmt->execute(array(
        "zfrom" => $from_person,
        "zto" => $to_person,
        "zmsg" => $msg,
        "zdate" => $date,
        "ztravel_id" => $travel_id
    ));
}
