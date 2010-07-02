--TEST--
test the attributes of the time element
--FILE--
<?php
include("../php-lib/init.php");
echo <time class="dtstart" datetime="2007-10-05" pubdate="true">October 5</time> . "\n";
--EXPECT--
<time class="dtstart" datetime="2007-10-05" pubdate="1">October 5</time>
