<?php
/*
Created by mohamed ramadan
Email:mr319242@gmail.com
Phone:01011642731

*/
include "../connect.php";
include "config.php";
$tem  = "include/tempelate/";
$func = "include/function/";
$css = "themes/css/";
$js  = "themes/js/";

include $tem."header.php";


if (!isset($Nonavbar)) {
	include $tem."navbar.php";
}

?>
