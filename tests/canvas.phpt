--TEST--
test the attributes of the canvas element;
--FILE--
<?php
include("../php-lib/init.php");
echo <canvas width="100" height="200"></canvas>;
--EXPECTF--
<canvas width="100" height="200"></canvas>
