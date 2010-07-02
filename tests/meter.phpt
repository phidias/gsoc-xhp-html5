--TEST--
test the attributes of the meter element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <meter max="100" value="0.25" form="testform"><b>50%</b></meter> . "\n";
echo <meter max="100" value="50" form="testform"></meter> . "\n";
echo <meter low="0.1" high="0.6" optimum="0.23">0.23 optimum</meter> . "\n";
--EXPECTF--
<meter max="100" value="0.25" form="testform"><b>50%</b></meter>
<meter max="100" value="50" form="testform"></meter>
<meter low="0.1" high="0.6" optimum="0.23">0.23 optimum</meter>
