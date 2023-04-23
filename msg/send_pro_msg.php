<?php
include "../connect.php";
if (isset($_POST['msg']) && $_POST['msg'] != '') {

    $from_person = $_POST['from_person'];
    $to_person = $_POST['to_person'];
    $msg = $_POST['msg'];
    $date = date("Y-m-d h:i:sa");
    $pro_id = $_POST['pro_id'];
    $stmt = $connect->prepare("INSERT INTO chat (msg_from, msg_to, msg, date,pro_id)
    value(:zfrom, :zto, :zmsg , :zdate,:zpro_id)
    ");
    $stmt->execute(array(
        "zfrom" => $from_person,
        "zto" => $to_person,
        "zmsg" => $msg,
        "zdate" => $date,
        "zpro_id" => $pro_id
    ));
}
