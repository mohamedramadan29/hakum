<?php
ob_start();
$page_title = ' تفعيل الحساب  ';
session_start();

include 'init.php';
if (isset($_GET['active_code'])) {
    $active_code = $_GET['active_code'];
}
?>
<!-- <div class="register_form forget_email" style='background-color:#f1f1f1'>
    <div class="container">
        <br>
        <br>
        <div class="data">
            <h2> تفعيل الحساب الخاص بك </h2>
            <form class="message_form" action="#" method="post">
                <?php
                $email = $_SESSION['mail'];
                ?>
                <div class="box">
                    <input class="form-control" type="text" name="code" placeholder="  من فضلك ادخل كود التفعيل المرسل علي البريد الالكتروني  ">
                </div>
                <div class="box" style="margin-top: 20px; padding-bottom: 60px;">
                    <button name="active_code" type="submit" class="btn btn-primary" style="margin: auto; display: block;"> تفعيل </button>
                </div>
            </form>
        </div>
    </div>
</div> -->
<?php
if (isset($_GET['active_code'])) {
    $active_code = $_GET['active_code'];
    $stmt = $connect->prepare("SELECT * FROM users WHERE active_status_code =? ");
    $stmt->execute(array($active_code));
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare("UPDATE users SET active_status = 1 WHERE active_status_code=?");
        $stmt->execute(array($active_code));
        if ($stmt) {
?>
            <div class="section section-md contact_us login_page" style='background-color:#f1f1f1'>
                <div class="container">
                    <div class="register_form">
                        <div class="alert alert-success"> تم تفعيل الحساب بنجاح سجل دخول الان </div>
                    </div>
                </div>
            </div>

<?php
            header("refresh:1;url=login");
        }
    }
}

?>