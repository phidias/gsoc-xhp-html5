<?php

include("../php-lib/init.php");
echo <link href="http://test.com"></link>;
//should produce an error on the next line
echo <link href="http://test.com" charset="utf-8"></link>;
	
?>
