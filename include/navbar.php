<nav class="navbar navbar-expand-lg ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index">هاكم </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
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
        if (isset($_SESSION['username'])) { ?>

          <li class="nav-item notification"> <a href="#"> <i class="fa fa-envelope nav-link"></i> </a> </li>
          <li class="nav-item notification"> <a href="#"> <i class="fa fa-bell nav-link"></i> </a> </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="uploads/avatar.gif" alt="">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="profile"> <i class="fa fa-user"></i> حسابي </a></li>
              <li><a class="dropdown-item" href="all_travel"> <i class="fa fa-plane"></i> رحلاتي </a></li>
              <li><a class="dropdown-item" href="all_product"> <i class="fa fa-book"></i> شحناتي </a></li>
              <li><a class="dropdown-item" href="add_travel"> <i class="fa fa-plus"></i> اضافة رحلة </a></li>
              <li><a class="dropdown-item" href="add_product"> <i class="fa fa-plus"></i> اضافة شحنة </a></li>
              <li><a class="dropdown-item" href="balance"> <i class="fa fa-dollar"></i> الرصيد </a></li>
              <li><a class="dropdown-item" href="logout"> <i class="fa fa-sign-out"></i> تسجيل خروج </a></li>
            </ul>
          </li>
        <?php

        } else {
        ?>
          <li class="nav-item new_account">
            <a id="register" class="nav-link" href="register"> حساب جديد </a>
          </li>
          <li class="nav-item login">
            <a id="login" class="nav-link" href="login"> دخول </a>
          </li>
        <?php
        }

        ?>


      </ul>
    </div>
  </div>
</nav>