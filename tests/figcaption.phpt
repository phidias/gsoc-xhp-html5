--TEST--
test the new global attributes
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <div><figure><figcaption>This is a caption inside a figure</figcaption></figure></div> . "\n";
echo <div><figcaption>This is a caption outside a figure</figcaption></div> . "\n";
--EXPECTF--
<div><figure><figcaption>This is a caption inside a figure</figcaption></figure></div>

Fatal error:%s
