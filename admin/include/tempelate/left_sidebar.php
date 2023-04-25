  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <span class="brand-text font-weight-light"> <?php echo $website_title ?> </span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3" style="line-height:0">
          </div>
          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item" id="lnk-expenses">
                      <a href="main.php?dir=dashboard&page=dashboard" class="nav-link">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              الرئيسية
                          </p>
                      </a>
                  </li>

                  <!-- START EDUCATION WEBSITE  -->

                  <!-- START WHATSAPP -->
                  <li class="nav-item" id="lnk-whatsapp">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa fa-building color2"></i>
                          <p>
                              المستخدمين
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item" id="lnk-rep-whatsapp">
                              <a href="main.php?dir=users&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> مشاهدة المستخدمين </p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <!-- END WHATSAPP -->

                  <!--   START COUNTRY -->
                  <li class="nav-item" id="lnk-country">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa-solid fa-users color2"></i>
                          <p>
                              الرحلات
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item" id="lnk-rep-country">
                              <a href="main.php?dir=travels&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> مشاهدة الرحلات </p>
                              </a>
                          </li>
                      </ul>
                  </li>

                  <!-- END   COUNTRY -->

                  <!--   START Coashes Section -->
                  <li class="nav-item" id="lnk-coash">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa-solid fa-images color2"></i>
                          <p>
                              الشحنات
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item" id="lnk-rep-coash">
                              <a href="main.php?dir=products&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> مشاهدة الشحنات </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <!-- END Coashes Section -->


                  <!-- END Services Section 
                  <li class="nav-item" id="lnk-message">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa-solid fa-envelope color2"></i>
                          <p>
                              رسائل المستخدمين
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item" id="lnk-contact">
                              <a href="main.php?dir=all_chats&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> مشاهدة جميع الرسائل </p>
                              </a>
                          </li>
                      </ul>
                  </li>
-->
                  <!--   START Add balance  -->
                  <li class="nav-item" id="lnk-coash">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa-solid fa-images color2"></i>
                          <p>
                              الصفقات والرصيد
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item" id="lnk-rep-coash">
                              <a href="main.php?dir=balance&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> الرحلات </p>
                              </a>
                          </li>
                          <li class="nav-item" id="lnk-rep-coash">
                              <a href="main.php?dir=balance2&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> الشحنات </p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <!-- END Add Balance  -->
                  <!--   START Add balance  -->
                  <li class="nav-item" id="lnk-coash">
                      <a href="main.php?dir=withdraw&page=report" class="nav-link nav-link2">
                          <i class="fa-solid fa-images color2"></i>
                          <p>
                              طلبات السحب
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      
                  </li>
                  <!-- END Add Balance  -->
                  <li class="nav-item" id="lnk-message">
                      <a href="#" class="nav-link nav-link2">
                          <i class="fa-solid fa-envelope color2"></i>
                          <p>
                              الرسائل
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">

                          <li class="nav-item" id="lnk-contact">
                              <a href="main.php?dir=contact&page=report" class="nav-link">
                                  <i class="far fa-circle nav-icon color3"></i>
                                  <p> مشاهدة جميع الرسائل </p>
                              </a>
                          </li>
                      </ul>
                  </li>



                  <li class="nav-item" id="lnk-review">
                      <a href="main.php?dir=settings&page=report" class="nav-link nav-link2">
                          <i class="fa fa-dashboard color2"></i>
                          <p>
                              الاعدادات
                              <i class="right fas fa-angle-left "></i>
                          </p>
                      </a>

                  </li>

                  <li class="nav-item">
                      <a href="signout.php" class="nav-link">
                          <i class="fa-solid fa-arrow-right-from-bracket color11"></i>
                          <p>
                              تسجيل خروج
                              <i class=""></i>
                          </p>
                      </a>
                  </li>



                  <!-- END EDUCATION WEBSITE -->
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>