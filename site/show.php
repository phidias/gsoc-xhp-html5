<?php
include("../php-lib/init.php");

function getCode($element,$attr) {
	if ($attr != NULL)
		$contents = file_get_contents("attributes/$element-$attr.php");
	else
		$contents = file_get_contents("elements/$element.php");
	$contents = preg_replace('/\/\/.*\n/',"",$contents);
	$contents = preg_replace('/<\?php\n/',"",$contents);
	$contents = preg_replace('/\?>\n/',"",$contents);
	$contents = preg_replace('/echo\s*/',"",$contents);
	$contents = preg_replace('/>;/',">",$contents);
	return $contents;
}

if (isset($_GET['el'])) {
	if (isset($_GET['attr'])) {
		$attr = "&attr={$_GET['attr']}";
	}
    $browserURL = "render.php?el={$_GET['el']}&target=browser{$attr}";
	$xhpURL = "render.php?el={$_GET['el']}&target=xhp{$attr}";
	echo <a href="index.php">Back</a>;
	if (isset($_GET['attr']))
		echo <h1>&lt;{$_GET['el']}.{$_GET['attr']}&gt;</h1>;
	else
		echo <h1>&lt;{$_GET['el']}&gt;</h1>;
	echo <h2>Code</h2>;
	echo <pre style="padding: 5px;border:2px solid black; background-color:#F8F8F8;">{getCode($_GET['el'],$_GET['attr'])}</pre>;
	echo <h2>Browser Rendering</h2>;
	echo '<iframe src="'.$browserURL.'" width="100%" height="40%" style="border:2px solid blue"></iframe>';
	echo <h2>XHP Rendering</h2>;
	echo '<iframe src="'.$xhpURL.'" width="100%" height="40%" style="border:2px solid green"></iframe>';
}
?>
