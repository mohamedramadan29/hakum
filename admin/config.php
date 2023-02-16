<?php

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
} elseif (
    isset($_GET['lang']) &&
    $_SESSION['lang'] != $_GET['lang'] &&
    !empty($_GET['lang'])
) {
    if ($_GET['lang'] == 'ar') {
        $_SESSION['lang'] = 'ar';
    } elseif ($_GET['lang'] == 'en') {
        $_SESSION['lang'] = 'en';
    }
}
if (isset($_GET['dir'])) {
    $dir = $_GET['dir'];

    if ($dir == 'company') {
        include 'company/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'users') {
        include 'users/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'car_type') {
        include 'car_type/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'banner') {
        include 'banner/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'car_kind') {
        include 'car_kind/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'car_type') {
        include 'car_type/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'cars') {
        include 'cars/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'category') {
        include 'category/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'city') {
        include 'city/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'dashboard') {
        include 'dashboard/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'rental') {
        include 'rental/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'faq') {
        include 'faq/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'faqs') {
        include 'faqs/lang/' . $_SESSION['lang'] . '.php';
    } elseif ($dir == 'contact') {
        include 'contact/lang/' . $_SESSION['lang'] . '.php';
    }
    // START NEW WEBSITE EDUCATION
    // START WHATSAPP
    elseif ($dir == 'whatsapp') {
        include 'whatsapp/lang/' . $_SESSION['lang'] . '.php';
    }
    elseif ($dir == 'country') {
        include 'country/lang/' . $_SESSION['lang'] . '.php';
    }
    elseif ($dir == 'courses') {
        include 'courses/lang/' . $_SESSION['lang'] . '.php';
    }

    elseif ($dir == 'customer') {
        include 'customer/lang/' . $_SESSION['lang'] . '.php';
    }
    elseif ($dir == 'degree') {
        include 'degree/lang/' . $_SESSION['lang'] . '.php';
    }

    elseif ($dir == 'news') {
        include 'news/lang/' . $_SESSION['lang'] . '.php';
    }
    elseif ($dir == 'specialist') {
        include 'specialist/lang/' . $_SESSION['lang'] . '.php';
    }

    elseif ($dir == 'university') {
        include 'university/lang/' . $_SESSION['lang'] . '.php';
    }
    elseif ($dir == 'individual') {
        include 'individual/lang/' . $_SESSION['lang'] . '.php';
    }


    // END NEW WEBSITE EDUCATION
} else {
    include 'languages/lang/' . $_SESSION['lang'] . '.php';
}