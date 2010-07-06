<?php
require_once '../php-lib/core.php';
if (isset($_GET['target'])) {
	if ($_GET['target'] == "browser")
		require_once '../php-lib/html5-syntax.php';
	else
		require_once '../php-lib/html5.php';
}
if (isset($_GET['el'])) {
	if (isset($_GET['attr']))
		require "attributes/{$_GET['el']}-{$_GET['attr']}.php";
	else
		require "elements/{$_GET['el']}.php";
} else {
	echo "No element specified";
}
