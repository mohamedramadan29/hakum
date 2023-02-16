<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $admin_id = $_POST['admin_id'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $admin_name = $_POST['admin_name'];

    $stmt = $connect->prepare("UPDATE admin SET admin_name=?,admin_password=?,admin_email=? WHERE admin_id=?");
    $stmt->execute([$admin_name, $admin_password, $admin_email, $admin_id]);
    if ($stmt) { ?>
        <div class="container">
            <div class="alert-success">
                تم تعديل القسم بنجاح
                <?php
                header('LOCATION:main.php?dir=settings&page=report');
                ?>
            </div>
        </div>
<?php }
}
