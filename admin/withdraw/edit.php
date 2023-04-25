<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cus_id = $_POST['cus_id'];
    $cus_state = filter_var(
        $_POST['cus_state'],
        FILTER_SANITIZE_STRING
    );  
    $cus_confirm = filter_var(
        $_POST['cus_confirm'],
        FILTER_SANITIZE_STRING
    );  

    $stmt = $connect->prepare("UPDATE customer SET cus_state=?,cus_confirm=?  WHERE cus_id=?");
    $stmt->execute([ $cus_state,$cus_confirm, $cus_id
    ]); 
    if ($stmt) { ?>
        <div class="container">
            <div class="alert-success">
                تم تعديل المستخدم بنجاح

                <?php // header('refresh:3,url=main.php?dir=city&page=report'); 
                ?>
            </div>
        </div>

<?php }
}
