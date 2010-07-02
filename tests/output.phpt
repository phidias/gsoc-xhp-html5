--TEST--
test the attributes of the time element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <output name="result" for="a b c" form="testform"/>;
--EXPECT--
<output name="result" for="a b c" form="testform"></output>

