--TEST--
test the audio element (source etc)
--FILE--
<?php
include("../php-lib/init.php");
echo <audio src="test.mp3" autoplay="true"></audio> . "\n";
echo <audio><source src="audio3.mp3" type="audio/mp3" media="all" /></audio> . "\n";
echo <audio><source src="audio3.mp3" type="audio/mp3" media="all" /><p>Your browser is not working ok?</p></audio> . "\n";
echo <audio>Your browser is not working ok?</audio> . "\n";
echo <audio><p>Your browser is not working ok?</p><source src="audio3.mp3" type="audio/mp3" media="all" /></audio> . "\n";
--EXPECTF--
<audio src="test.mp3" autoplay="1"></audio>
<audio><source src="audio3.mp3" type="audio/mp3" media="all" /></audio>
<audio><source src="audio3.mp3" type="audio/mp3" media="all" /><p>Your browser is not working ok?</p></audio>
<audio>Your browser is not working ok?</audio>

Fatal error%s
