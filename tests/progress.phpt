--TEST--
test the progress element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <progress max="100" value="50" form="testform"><b>50%</b></progress> . "\n";
echo <progress max="100" value="50" form="testform"></progress> . "\n";
--EXPECTF--
<progress max="100" value="50" form="testform"><b>50%</b></progress>
<progress max="100" value="50" form="testform"></progress>
