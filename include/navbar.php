<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index"> <img style="max-width: 65px;" src="uploads/logo2_new.png" alt=""> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" id="index" aria-current="page" href="index">الرئيسية</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="travels" href="travels"> رحلات </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="products" href="products"> شحنات </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="contact_us" href="contact_us"> تواصل معنا </a>
        </li>
        <?php
        if (isset($_SESSION['username'])) {
          /*
          $stmt = $connect->prepare("SELECT COUNT(id) as count_id, msg_from, msg_to, travel_id FROM chat WHERE msg_to=? GROUP BY msg_from, travel_id ORDER BY count_id DESC LIMIT 15");
          $stmt->execute(array($_SESSION['username']));*/
          include "message_noti_icons/message.php";
          include "message_noti_icons/notification.php";
        ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                $stmt = $connect->prepare("SELECT * FROM users WHERE name=?");
                $stmt->execute(array($_SESSION['username']));
                $user_data = $stmt->fetch();
                if($user_data['profile_image'] !=null && $user_data['profile_image'] !=''){
                    ?>
                    <img src="website_uploads/<?php echo $user_data['profile_image'] ?>" alt="">
                <?php
                }else{
                    ?>
                    <img src="uploads/avatar.gif" alt="">
                <?php
                }
                ?>

            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="profile"> <i class="fa fa-user"></i> حسابي </a></li>
              <li><a class="dropdown-item" href="all_travel"> <i class="fa fa-plane"></i> رحلاتي </a></li>
              <li><a class="dropdown-item" href="all_product"> <i class="fa fa-book"></i> شحناتي </a></li>
              <li><a class="dropdown-item" href="add_travel"> <i class="fa fa-plus"></i> اضافة رحلة </a></li>
              <li><a class="dropdown-item" href="add_product"> <i class="fa fa-plus"></i> اضافة شحنة </a></li>
              <li><a class="dropdown-item" href="balance"> <i class="fa fa-dollar"></i> الرصيد </a></li>
              <li><a class="dropdown-item" href="logout"> <i class="fa fa-sign-out"></i> تسجيل خروج </a></li>
              <li><a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button" style="color:red" class="dropdown-item"> <i class="fa fa-trash"></i> الغاء الحساب </a></li>
            </ul>
          </li>
        <?php

        } else {
        ?>
            <li class="nav-item login">
                <a id="login" class="nav-link" href="login"> دخول </a>
            </li>
          <li class="nav-item new_account">
            <a id="register" class="nav-link" href="register"> حساب جديد </a>
          </li>

        <?php
        }

        ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <br>
  <br>
  <br>
  <div class="modal-dialog">
    <form action="remove_account" method="post">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">الغاء الحساب </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p> هل انت متاكد من الغاء الحساب الخاص بك </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">اغلاق</button>
          <button type="submit" class="btn btn-danger">نعم متاكد </button>
        </div>
      </div>
    </form>
  </div>
</div>