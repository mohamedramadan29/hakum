<?php
if (isset($_POST['send_message'])) {
    $from = $_SESSION['username'];
    $to = $_POST['to_person'];
    $msg = $_POST['message_data'];
    $date = date("Y-m-d h:i:sa");
    $travel_id = $_POST['travel_id'];
    $stmt = $connect->prepare("INSERT INTO chat (msg_from, msg_to, msg, date,travel_id)
    value(:zfrom, :zto, :zmsg , :zdate,:ztravel_id)
    ");
    $stmt->execute(array(
        "zfrom" => $from,
        "zto" => $to,
        "zmsg" => $msg,
        "zdate" => $date,
        "ztravel_id" => $travel_id
    ));
}
