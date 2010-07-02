--TEST--
test the new type attribute of the input element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <input type="month" /> . "\n";
echo <input type="week" name="kkk" />;
--EXPECT--
<input type="month" />
<input type="week" name="kkk" />
