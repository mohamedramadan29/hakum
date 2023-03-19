<li class="nav-item notification dropdown" aria-labelledby="navbarDropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell nav-link"></i> </a>
    <?php
    $stmt = $connect->prepare("SELECT * FROM all_notification WHERE noti_to = ? AND noti = 0");
    $stmt->execute(array($_SESSION['username']));
    $alldeal = $stmt->fetchAll();
    $count = $stmt->rowCount();
    if ($count > 0) {
    ?>
        <span class="noti_num"> <?php echo $count; ?> </span>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            foreach ($alldeal as $deal) {
            ?>
                <li><a class="dropdown-item" href="../deals"> <?php echo $deal['message']; ?> </a></li>
            <?php
            }
            ?>

        </ul>
    <?php
    } else {
        /*
        $stmt = $connect->prepare("SELECT * FROM travel_deal WHERE travel_owner=?");
        $stmt->execute(array($_SESSION['username']));
        $alldeal = $stmt->fetchAll();
        $count = $stmt->rowCout();
        if($count > 0){
            ?>
            <?php

        }else{?>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="profile"> <i class="fa fa-user"></i> لا يوجد صفقات لديك حتي الان  </a></li>
        </ul>
        <?php
        }
        */
    }
    ?>


</li>