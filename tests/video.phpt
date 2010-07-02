--TEST--
test the video element
--FILE--
<?php
include("../php-lib/init-tests.php");
echo <video>your browser doesnt support this</video> . "\n";
echo <video autoplay="true" preload="auto" loop="true" controls="false" width="40" height="50"></video> . "\n";
echo <video width="40test" height="50px"></video> . "\n";
--EXPECT--
<video>your browser doesnt support this</video>
<video autoplay="1" preload="auto" loop="1" width="40" height="50"></video>
<video width="40" height="50"></video>
