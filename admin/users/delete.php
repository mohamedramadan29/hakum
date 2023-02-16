<?php
if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $stmt = $connect->prepare('SELECT * FROM users WHERE user_id= ?');
    $stmt->execute([$user_id]);
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare('DELETE FROM users WHERE user_id=?');
        $stmt->execute([$user_id]);
        if ($stmt) { ?>
            <div class="alert-success">
                <?php echo $lang['delete_message']; ?>
                <?php header('LOCATION:main.php?dir=users&page=report'); ?>
    <?php }
    }
}
