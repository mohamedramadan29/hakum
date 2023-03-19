<?php
session_start();
include "connect.php";
if (isset($_POST['sub_total'])) {
    $sub_total = filter_var($_POST['sub_total'], FILTER_SANITIZE_NUMBER_INT);
    $forerror = [];
    if (empty($sub_total)) {
        $forerror[] = 'من فضلك ادخل المبلغ المراد شحنة';
    } else {

        $discount = 0;
        $total = $_POST['sub_total'];
    }
    if (empty($forerror)) {
        $stmt = $connect->prepare("INSERT INTO balance_add (user_name, balance_subtotal,balance_discount ,balance_total) VALUES
                                    (:zusername, :zsubtotal, :zdiscount, :ztotal)");
        $stmt->execute(array(
            "zusername" => $_SESSION['username'],
            "zsubtotal" => $sub_total,
            "zdiscount" => $discount,
            "ztotal" => $total,
        ));

        $stmt = $connect->prepare("SELECT * FROM balance_add WHERE user_name=?");
        $stmt->execute(array($_SESSION['username']));
        $alldata = $stmt->fetchAll();
        $sum_total = 0;
        foreach ($alldata as $data) {
            $sum_total += $data['balance_total'];
        }
        $stmt = $connect->prepare("UPDATE users SET balance=? WHERE name=?");
        $stmt->execute(array($sum_total, $_SESSION['username']));
        if ($stmt) {
            echo "201";
?>

        <?php
        }
    } else {
        foreach ($forerror as $error) {
        ?>
            <div class="alert alert-danger"> <?php echo $error ?> </div>
<?php
        }
    }
}
?>