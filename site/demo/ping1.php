<?php
if (isset($_GET['show'])) {
	if (isset($_COOKIE['ping1']))
		echo $_COOKIE['ping1'];
	else
		echo "not pinged";
} else {
	setcookie("ping1","pinged at ".date('l jS \of F Y h:i:s A'));
}