--TEST--
test the attributes of the command element
--FILE--
<?php
include("../php-lib/init.php");
echo <command type="radio" radiogroup="r1" disabled="true" /> . "\n";
--EXPECT--
<command type="radio" radiogroup="r1" disabled="1" />
