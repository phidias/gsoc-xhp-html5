<?php
include("../php-lib/init.php");
if (isset($_GET['el'])) {
    $browserURL = "render.php?el={$_GET['el']}&target=browser";
	$xhpURL = "render.php?el={$_GET['el']}&target=xhp";
	echo <h2>Browser Rendering</h2>;
	echo '<iframe src="'.$browserURL.'" width="100%" height="40%" style="border:0px"></iframe>';
	echo <h2>XHP Rendering</h2>;
	echo '<iframe src="'.$xhpURL.'" width="100%" height="40%" style="border:0px"></iframe>';
}
?>
