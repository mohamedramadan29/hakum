<?php
session_start();
include '../connect.php';
if (isset($_POST['recieve_deal'])) {
    $travel_id = $_POST['travel_id'];
    $travel_owner = $_POST['travel_owner'];
    $product_owner = $_POST['product_owner'];
    $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE travel_owner=? AND product_owner=? AND travel_id=? AND status=1");
    $stmt->execute(array($travel_owner,$product_owner,$travel_id));
    $deal_data = $stmt->fetch();
    $travel_balance = $deal_data['total'];
    $count = $stmt->rowCount();
    if($count > 0){
        $stmt = $connect->prepare("UPDATE travel_deal SET status=2 WHERE travel_owner=? AND product_owner=? AND travel_id=? AND status=1");
        $stmt->execute(array($travel_owner,$product_owner,$travel_id));
        $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
        $stmt->execute(array($travel_owner));
        $userdata = $stmt->fetch();
        $old_balance = $userdata['balance'];
        $count2 = $stmt->rowCount();
        if($count2 > 0){
            $new_balance = $old_balance + $travel_balance;
            $stmt = $connect->prepare("UPDATE users SET balance=? WHERE name=?");
            $stmt->execute(array($new_balance,$travel_owner));
        }
        if($stmt){
            ?>
            <div class="container">
                <div class="alert alert-success" style="color: #0f5132; background-color: #d1e7dd; text-align:center; padding:10px; margin-top:50px;font-size:22px;"> تم اتمام واستلام الصفقة بنجاح </div>
            </div>
            <?php
            header('refresh:2;URL=../profile');
        }
    }else{
        echo "No";
    }
}
