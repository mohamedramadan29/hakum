<?php
if (isset($_GET['travel_id']) && is_numeric($_GET['travel_id'])) {
    $travel_id = $_GET['travel_id'];

    $stmt = $connect->prepare('SELECT * FROM travels WHERE travel_id= ?');
    $stmt->execute([$travel_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM travels WHERE travel_id=?');
        $stmt->execute([$travel_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=travels&page=report'); ?>
    <?php }
    }
}
