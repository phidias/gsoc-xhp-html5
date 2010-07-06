<?php
if (isset($_GET['show'])) {
	if (isset($_COOKIE['ping2']))
		echo $_COOKIE['ping2'];
	else
		echo "not pinged";
} else {
	setcookie("ping2","pinged at ".date('l jS \of F Y h:i:s A'));
}