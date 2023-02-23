<?php
if (isset($_GET['pro_id']) && is_numeric($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];

    $stmt = $connect->prepare('SELECT * FROM products WHERE pro_id= ?');
    $stmt->execute([$pro_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM products WHERE pro_id=?');
        $stmt->execute([$pro_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=products&page=report'); ?>
    <?php }
    }
}
